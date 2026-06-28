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
    public function index(Request $request)
    {
        $tenant_id  = Auth::user()->tenant_id;
        $categories = Category::where('tenant_id', $tenant_id)->get();

        $products = Product::where('tenant_id', $tenant_id)
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('sku', 'like', "%{$search}%");
            })
            ->when($request->category, function ($query, $category) {
                $query->where('category_id', $category);
            })
            ->get();

        return view('products.index', compact('products', 'categories'));
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

    // Show edit form
    public function edit(Product $product)
    {
        // Security check — tenant can only edit their own products
        if ($product->tenant_id !== Auth::user()->tenant_id) {
            abort(403);
        }

        $tenant_id  = Auth::user()->tenant_id;
        $categories = Category::where('tenant_id', $tenant_id)->get();
        $units      = Unit::where('tenant_id', $tenant_id)->get();

        return view('products.edit', compact('product', 'categories', 'units'));
    }

    // Update product
    public function update(Request $request, Product $product)
    {
        if ($product->tenant_id !== Auth::user()->tenant_id) {
            abort(403);
        }

        $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'category_id'   => ['required', 'exists:categories,id'],
            'unit_id'       => ['required', 'exists:units,id'],
            'sku'           => ['required', 'string', 'max:255'],
            'cost_price'    => ['required', 'numeric', 'min:0'],
            'selling_price' => ['required', 'numeric', 'min:0'],
            'min_stock'     => ['required', 'integer', 'min:0'],
        ]);

        $product->update([
            'category_id'   => $request->category_id,
            'unit_id'       => $request->unit_id,
            'name'          => $request->name,
            'sku'           => $request->sku,
            'barcode'       => $request->barcode,
            'description'   => $request->description,
            'cost_price'    => $request->cost_price,
            'selling_price' => $request->selling_price,
            'min_stock'     => $request->min_stock,
            'max_stock'     => $request->max_stock ?? 0,
            'track_expiry'  => $request->boolean('track_expiry'),
            'is_active'     => $request->boolean('is_active'),
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully!');
    }

    // Delete product
    public function destroy(Product $product)
    {
        if ($product->tenant_id !== Auth::user()->tenant_id) {
            abort(403);
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully!');
    }
}
