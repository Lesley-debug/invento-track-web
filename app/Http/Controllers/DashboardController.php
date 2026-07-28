<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockLevel;
use App\Models\StockMovement;
use App\Models\SalesOrder;
use App\Models\Invoice;
use App\Models\PurchaseOrder;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $tenant_id = Auth::user()->tenant_id;

        $totalProducts = Product::where('tenant_id', $tenant_id)->count();

        $stockLevels = StockLevel::with('product')
            ->whereHas('product', fn($q) => $q->where('tenant_id', $tenant_id))
            ->get();

        $totalInStock   = $stockLevels->where('quantity', '>', 0)->count();
        $lowStockCount  = $stockLevels->filter(fn($l) => $l->quantity <= $l->product->min_stock && $l->quantity > 0)->count();
        $outOfStock     = $stockLevels->where('quantity', '<=', 0)->count();

        $recentMovements = StockMovement::with(['product', 'location'])
            ->whereHas('product', fn($q) => $q->where('tenant_id', $tenant_id))
            ->latest()
            ->take(5)
            ->get();

        $pendingOrders  = SalesOrder::where('tenant_id', $tenant_id)->where('status', 'pending')->count();
        $unpaidInvoices = Invoice::where('tenant_id', $tenant_id)->whereIn('status', ['draft', 'sent'])->count();
        $pendingPOs     = PurchaseOrder::where('tenant_id', $tenant_id)->whereIn('status', ['draft', 'ordered'])->count();

        return view('dashboard', compact(
            'totalProducts',
            'totalInStock',
            'lowStockCount',
            'outOfStock',
            'recentMovements',
            'pendingOrders',
            'unpaidInvoices',
            'pendingPOs'
        ));
    }
}
