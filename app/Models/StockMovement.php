<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class StockMovement extends Model
{
    use HasUuids;

    protected $fillable = [
        'tenant_id', 'product_id', 'location_id', 'user_id',
        'reference_id', 'reference_type', 'type', 'quantity',
        'unit_cost', 'note',
    ];

    protected $casts = [
        'unit_cost' => 'decimal:2',
    ];

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // NOTE: reference_type currently stores a short label (e.g. "purchase_order").
    // If you want this to work as a true Eloquent polymorphic relation,
    // store the full model class (App\Models\PurchaseOrder) instead, then:
    public function reference(): MorphTo
    {
        return $this->morphTo(__FUNCTION__, 'reference_type', 'reference_id');
    }
}
