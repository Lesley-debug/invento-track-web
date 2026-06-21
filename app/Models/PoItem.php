<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PoItem extends Model
{
    use HasUuids;

    protected $table = 'po_items';

    protected $fillable = [
        'purchase_order_id', 'product_id', 'quantity_ordered',
        'quantity_received', 'unit_cost', 'expiry_date',
    ];

    protected $casts = [
        'unit_cost' => 'decimal:2',
        'expiry_date' => 'date',
    ];

    public function purchaseOrder(): BelongsTo
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
