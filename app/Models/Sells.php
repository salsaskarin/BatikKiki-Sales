<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sells extends Model
{
    use HasFactory;

    protected $table = 'sells';

    protected $fillable = [
        'product_id',
        'customer',
        'quantity',
        'price',
        'total'
    ];

    public function product()
    {
        return $this->belongsToMany(Product::class);
    }
}
