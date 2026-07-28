<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Location;
use App\Models\Product;
use App\Models\SaleItem;
use App\Models\SalesOrder;
use App\Models\StockLevel;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SalesOrderController extends Controller
{
    public function index()
    {
        $salesOrders = SalesOrder::with('customer')
            ->where('tenant_id', Auth::user()->tenant_id)
            ->latest()
            ->get();

        return view('sales-orders.index', compact('salesOrders'));
    }

    public function create()
    {
        $tenant_id = Auth::user()->tenant_id;
        $customers = Customer::where('tenant_id', $tenant_id)->get();
        $products  = Product::where('tenant_id', $tenant_id)->where('is_active', true)->get();
        $locations = Location::where('tenant_id', $tenant_id)->get();

        return view('sales-orders.create', compact('customers', 'products', 'locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id'        => ['required', 'exists:customers,id'],
            'location_id'        => ['required', 'exists:locations,id'],
            'notes'              => ['nullable', 'string'],
            'items'              => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['required', 'exists:products,id'],
            'items.*.quantity'   => ['required', 'integer', 'min:1'],
        ]);

        $tenant_id = Auth::user()->tenant_id;

        DB::transaction(function () use ($request, $tenant_id) {
            // Generate order number
            $orderNumber = 'SO-' . strtoupper(uniqid());

            // Calculate total
            $total = 0;
            foreach ($request->items as $item) {
                $product = Product::find($item['product_id']);
                $total += $product->selling_price * $item['quantity'];
            }

            $salesOrder = SalesOrder::create([
                'tenant_id'    => $tenant_id,
                'customer_id'  => $request->customer_id,
                'location_id'  => $request->location_id,
                'user_id'      => Auth::id(),
                'order_number' => $orderNumber,
                'status'       => 'pending',
                'subtotal'     => $total,
                'total_amount' => $total,
                'notes'        => $request->notes,
            ]);

            foreach ($request->items as $item) {
                $product = Product::find($item['product_id']);
                SaleItem::create([
                    'sales_order_id' => $salesOrder->id,
                    'product_id'     => $item['product_id'],
                    'quantity'       => $item['quantity'],
                    'unit_price'     => $product->selling_price,
                    'total_price'    => $product->selling_price * $item['quantity'],
                ]);
            }
        });

        return redirect()->route('sales-orders.index')
            ->with('success', 'Sales order created successfully!');
    }

    public function show(SalesOrder $salesOrder)
    {
        if ($salesOrder->tenant_id !== Auth::user()->tenant_id) abort(403);
        $salesOrder->load(['customer', 'items.product', 'items.product.unit']);
        return view('sales-orders.show', compact('salesOrder'));
    }

    public function confirm(SalesOrder $salesOrder, Request $request)
    {
        if ($salesOrder->tenant_id !== Auth::user()->tenant_id) abort(403);
        if ($salesOrder->status !== 'pending') {
            return back()->with('error', 'This order has already been confirmed.');
        }

        $request->validate([
            'location_id' => ['required', 'exists:locations,id'],
        ]);

        DB::transaction(function () use ($salesOrder, $request) {
            // Decrement stock for each item
            foreach ($salesOrder->items as $item) {
                StockMovement::create([
                    'tenant_id'   => $salesOrder->tenant_id,
                    'product_id'  => $item->product_id,
                    'location_id' => $request->location_id,
                    'type'        => 'out',
                    'quantity'    => $item->quantity,
                    'notes'       => 'Sold via SO: ' . $salesOrder->order_number,
                    'user_id'     => Auth::id(),
                ]);

                $stockLevel = StockLevel::where('product_id', $item->product_id)
                    ->where('location_id', $request->location_id)
                    ->where('tenant_id', $salesOrder->tenant_id)
                    ->first();

                if ($stockLevel) {
                    $stockLevel->decrement('quantity', $item->quantity);
                }
            }

            // Auto-generate invoice
            $invoiceNumber = 'INV-' . strtoupper(uniqid());

            // Mark order as confirmed
            $salesOrder->update(['status' => 'confirmed']);

            Invoice::create([
                'tenant_id'      => $salesOrder->tenant_id,
                'sales_order_id' => $salesOrder->id,
                'customer_id'    => $salesOrder->customer_id,
                'invoice_number' => $invoiceNumber,
                'status'         => 'draft',
                'subtotal'       => $salesOrder->total_amount,
                'total_amount'   => $salesOrder->total_amount,
                'due_date'       => now()->addDays(30),
            ]);
        });

        return redirect()->route('sales-orders.show', $salesOrder)
            ->with('success', 'Order confirmed! Invoice generated automatically.');
    }
}
