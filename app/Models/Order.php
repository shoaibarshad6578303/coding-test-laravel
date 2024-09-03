<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'order_number',
        'order_date',
        'shipped_date',
        'status',
    ];

     /**
     * get order customer
     *
     * @return BelongsTo
     */
    public function customer():BelongsTo
    {
        return $this->belongsTo(
            Customer::class,
            'customer_id',
            'id',
            'customer'
        );
    }
    
     /**
     * get order items
     *
     * @return HasMany
     */
    public function items():HasMany
    {
        return $this->hasMany(
            OrderItem::class,
            'order_id',
            'id'
        );
    }

}