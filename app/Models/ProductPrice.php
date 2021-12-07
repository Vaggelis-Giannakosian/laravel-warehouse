<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'datetime',
        'product_id'
    ];

    protected $casts = [
        'datetime' => 'datetime'
    ];

    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

}
