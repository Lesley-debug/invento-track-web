<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Product;
use App\Models\StockLevel;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    // Show all stock levels
    public function index()
    {
        $tenant_id   = Auth::user()->tenant_id;
        $stockLevels = StockLevel::with(['product', 'location'])
            ->whereHas('product', function ($q) use ($tenant_id) {
                $q->where('tenant_id', $tenant_id);
            })
            ->get();

        $lowStock = $stockLevels->filter(function ($level) {
            return $level->quantity <= $level->product->min_stock;
        });

        return view('stock.index', compact('stockLevels', 'lowStock'));
    }

    // Show add stock form
    public function add()
    {
        $tenant_id = Auth::user()->tenant_id;
        $products  = Product::where('tenant_id', $tenant_id)->where('is_active', true)->get();
        $locations = Location::where('tenant_id', $tenant_id)->get();

        return view('stock.add', compact('products', 'locations'));
    }

    // Store stock movement
    public function store(Request $request)
    {
        $request->validate([
            'product_id'  => ['required', 'exists:products,id'],
            'location_id' => ['required', 'exists:locations,id'],
            'type'        => ['required', 'in:in,out,adjustment'],
            'quantity'    => ['required', 'integer', 'min:1'],
            'notes'       => ['nullable', 'string'],
        ]);

        $tenant_id = Auth::user()->tenant_id;

        // Security check
        $product  = Product::where('id', $request->product_id)
            ->where('tenant_id', $tenant_id)->firstOrFail();
        $location = Location::where('id', $request->location_id)
            ->where('tenant_id', $tenant_id)->firstOrFail();

        DB::transaction(function () use ($request, $product, $location, $tenant_id) {

            // Step 1 — Record the movement
            StockMovement::create([
                'tenant_id'   => $tenant_id,
                'product_id'  => $product->id,
                'location_id' => $location->id,
                'type'        => $request->type,
                'quantity'    => $request->quantity,
                'notes'       => $request->notes,
                'user_id'  => Auth::id(),
            ]);

            // Step 2 — Update or create stock level
            $stockLevel = StockLevel::firstOrCreate(
                [
                    'product_id'  => $product->id,
                    'location_id' => $location->id,
                    'tenant_id'   => $tenant_id,
                ],
                ['quantity' => 0]
            );

            // Step 3 — Adjust quantity based on movement type
            if ($request->type === 'in') {
                $stockLevel->increment('quantity', $request->quantity);
            } elseif ($request->type === 'out') {
                $stockLevel->decrement('quantity', $request->quantity);
            } else {
                // adjustment — set exact quantity
                $stockLevel->update(['quantity' => $request->quantity]);
            }
        });

        return redirect()->route('stock.index')
            ->with('success', 'Stock updated successfully!');
    }

    // Show stock movements history
    public function movements()
    {
        $tenant_id = Auth::user()->tenant_id;
        $movements = StockMovement::with(['product', 'location'])
            ->whereHas('product', function ($q) use ($tenant_id) {
                $q->where('tenant_id', $tenant_id);
            })
            ->latest()
            ->get();

        return view('stock.movements', compact('movements'));
    }
}
