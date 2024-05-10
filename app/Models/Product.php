<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'packages' => 'array',       
    ];
    protected $table = 'products';

    public function cat() {
        return $this->belongsTo(ProductCategory::class, 'category','id');
    }
    public function subcat() {
        return $this->belongsTo(SubCategory::class, 'subcategory','id');
    }
  
    public function user() {
        return $this->belongsTo(User::class);
    }
}
