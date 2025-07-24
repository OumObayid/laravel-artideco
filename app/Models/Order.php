<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'city',
        'address',
        'product_id',
        'color',
        'quantity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
