<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    public const PRODUCT_STATUS = [
        self::STATUS_ACTIVE,
        self::STATUS_INACTIVE
    ];


    protected $fillable = [
        'name',
        'ska',
        'current_price',
        'quantity',
        'status',
        'category_id',
        'provider_id',
    ];

    public function category():BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function provider():BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }

    public function prices():HasMany
    {
        return $this->hasMany(ProductPrice::class);
    }
}