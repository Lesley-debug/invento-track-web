<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // Show all products
    public function index()
    {
        $products = Product::where('tenant_id', Auth::user()->tenant_id)->get();
        return view('products.index', compact('products'));
    }

    // Show create form
    public function create()
    {
        $tenant_id = Auth::user()->tenant_id;
        $categories = Category::where('tenant_id', $tenant_id)->get();
        $units = Unit::where('tenant_id', $tenant_id)->get();
        return view('products.create', compact('categories', 'units'));
    }

    // Store new product
    public function store(Request $request)
    {
        $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'category_id'   => ['required', 'exists:categories,id'],
            'unit_id'       => ['required', 'exists:units,id'],
            'sku'           => ['required', 'string', 'max:255'],
            'cost_price'    => ['required', 'numeric', 'min:0'],
            'selling_price' => ['required', 'numeric', 'min:0'],
            'min_stock'     => ['required', 'integer', 'min:0'],
        ]);

        Product::create([
            'tenant_id'     => Auth::user()->tenant_id,
            'category_id'   => $request->category_id,
            'unit_id'       => $request->unit_id,
            'name'          => $request->name,
            'slug'          => Str::slug($request->name) . '-' . Str::random(4),
            'sku'           => $request->sku,
            'barcode'       => $request->barcode,
            'description'   => $request->description,
            'cost_price'    => $request->cost_price,
            'selling_price' => $request->selling_price,
            'min_stock'     => $request->min_stock,
            'max_stock'     => $request->max_stock ?? 0,
            'track_expiry'  => $request->boolean('track_expiry'),
            'is_active'     => true,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully!');
    }
}
