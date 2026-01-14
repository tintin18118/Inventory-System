<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'contact_name',
        'phone',
        'email',
        'address'
    ];

    /**
     * Get products for this supplier
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}