<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockHistory extends Model
{
    protected $fillable = [
        'product_id',
        'type',
        'quantity',
        'notes',
        'user_id'
    ];

    protected $casts = [
        'quantity' => 'integer'
    ];

    /**
     * Get the product for this stock history
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the user who made this stock change
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}