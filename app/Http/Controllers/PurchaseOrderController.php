<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\PoItem;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use App\Models\StockLevel;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $purchaseOrders = PurchaseOrder::with('supplier')
            ->where('tenant_id', Auth::user()->tenant_id)
            ->latest()
            ->get();

        return view('purchase-orders.index', compact('purchaseOrders'));
    }

    public function create()
    {
        $tenant_id = Auth::user()->tenant_id;
        $suppliers = Supplier::where('tenant_id', $tenant_id)->get();
        $products  = Product::where('tenant_id', $tenant_id)->where('is_active', true)->get();
        $locations = Location::where('tenant_id', $tenant_id)->get();

        return view('purchase-orders.create', compact('suppliers', 'products', 'locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id'        => ['required', 'exists:suppliers,id'],
            'location_id'        => ['required', 'exists:locations,id'],
            'expected_date'      => ['nullable', 'date'],
            'notes'              => ['nullable', 'string'],
            'items'              => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['required', 'exists:products,id'],
            'items.*.quantity'   => ['required', 'integer', 'min:1'],
            'items.*.unit_cost'  => ['required', 'numeric', 'min:0'],
        ]);

        $tenant_id = Auth::user()->tenant_id;

        DB::transaction(function () use ($request, $tenant_id) {
            // Generate PO number
            $poNumber = 'PO-' . strtoupper(uniqid());

            $po = PurchaseOrder::create([
                'tenant_id'   => $tenant_id,
                'supplier_id' => $request->supplier_id,
                'location_id' => $request->location_id,
                'po_number'   => $poNumber,
                'status'      => 'draft',
                'expected_date' => $request->expected_date,
                'notes'       => $request->notes,
                'created_by'  => Auth::id(),
            ]);

            foreach ($request->items as $item) {
                PoItem::create([
                    'purchase_order_id' => $po->id,
                    'product_id'        => $item['product_id'],
                    'quantity_ordered'  => $item['quantity'],
                    'unit_cost'         => $item['unit_cost'],
                    
                ]);
            }
        });

        return redirect()->route('purchase-orders.index')
            ->with('success', 'Purchase order created successfully!');
    }

    public function show(PurchaseOrder $purchaseOrder)
    {
        if ($purchaseOrder->tenant_id !== Auth::user()->tenant_id) abort(403);
        $purchaseOrder->load(['supplier', 'items.product', 'items.product.unit']);
        return view('purchase-orders.show', compact('purchaseOrder'));
    }

    // Mark PO as received — updates stock automatically
    public function receive(PurchaseOrder $purchaseOrder, Request $request)
    {
        if ($purchaseOrder->tenant_id !== Auth::user()->tenant_id) abort(403);
        if ($purchaseOrder->status === 'received') {
            return back()->with('error', 'This order has already been received.');
        }

        $request->validate([
            'location_id' => ['required', 'exists:locations,id'],
        ]);

        DB::transaction(function () use ($purchaseOrder, $request) {
            foreach ($purchaseOrder->items as $item) {
                // Record stock movement
                StockMovement::create([
                    'tenant_id'   => $purchaseOrder->tenant_id,
                    'product_id'  => $item->product_id,
                    'location_id' => $request->location_id,
                    'type'        => 'in',
                    'quantity'    => $item->quantity_ordered,
                    'notes'       => 'Received from PO: ' . $purchaseOrder->po_number,
                    'user_id'     => Auth::id(),
                ]);

                // Update stock level
                $stockLevel = StockLevel::firstOrCreate(
                    [
                        'product_id'  => $item->product_id,
                        'location_id' => $request->location_id,
                        'tenant_id'   => $purchaseOrder->tenant_id,
                    ],
                    ['quantity' => 0]
                );
                $stockLevel->increment('quantity', $item->quantity_ordered);
            }

            // Mark PO as received
            $purchaseOrder->update([
                'status'      => 'received',
                'received_date' => now(),
            ]);
        });

        return redirect()->route('purchase-orders.show', $purchaseOrder)
            ->with('success', 'Purchase order marked as received. Stock has been updated!');
    }
}
