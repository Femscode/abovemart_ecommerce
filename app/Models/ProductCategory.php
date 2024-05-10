<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'product_categories';
    public function product() {
        return $this->hasMany(Course::class,'product_id','id');
    }

    public function all_course() {
        return $this->hasMany(Course::class,'category','id');
    }
    public function subcategories() {
        
        return $this->hasMany(SubCategory::class,'category_id','id');
    }
}
