<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class OrderItem extends Model
{

    use HasFactory;
    
     /**
     * get order
     *
     * @return BelongsTo
     */
    public function order():BelongsTo
    {
        return $this->belongsTo(
            Order::class,
            'order_id',
            'id',
            'order'
        );
    }

    /**
     * get item
     *
     * @return BelongsTo
     */
    public function item():BelongsTo
    {
        return $this->belongsTo(
            Item::class,
            'item_id',
            'id',
            'item'
        );
    }


}

