<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ProductImage;
use App\Models\User;
use App\Models\Inquiry;
use App\Models\ProductLog;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class,'sub_category_id');
    }
    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
    public function productlogs()
    {
        return $this->hasMany(ProductLog::class, 'product_id');
    }
    // public function userproduct()
    // {
    //     return $this->belongsTo(User::class, 'id');
    // }
    public function user()
    {
        return $this->belongsTo(User::class, 'uid');
    }
    public function productinquiries()
    {
        return $this->hasMany(Inquiry::class, 'product_id');
    }
    public function getRouteKeyName()
{
    return 'productname'; // Yahan 'productname' us field ka naam hai jise aap URL mein dekhna chahte hain.
}
}
