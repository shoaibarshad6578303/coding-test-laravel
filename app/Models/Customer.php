<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'status',
    ];

    /**
     * RELATIONS
     */


    /**
     * Get the orders for the customer.
     */
    public function orders():HasMany
    {
        return $this->hasMany(
            Order::class,
            'customer_id',
            'id'
        );
    }
}