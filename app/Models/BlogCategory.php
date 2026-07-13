<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BlogSubCategory;
class BlogCategory extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function blogsubcategory()
    {
        return $this->hasMany(BlogSubCategory::class,'parent_category','id');
    }
}
