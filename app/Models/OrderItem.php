<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_code',
        'quantity',
        'single_price',
        'total_price',
        'menu_name',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_code', 'order_code');
    }
}
