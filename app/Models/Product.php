<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'code',
        'category_id',
        'barcode',
        'purchase_price',
        'selling_price',
        'stock',
        'is_active',
        'image',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
