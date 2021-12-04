<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductPrice extends Model
{
    use HasFactory;

    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    protected function getDatetimeAttribute($value)
    {
        if(empty($value)) return $value;

        return Carbon::createFromTimestamp( (int) $value);
    }
}
