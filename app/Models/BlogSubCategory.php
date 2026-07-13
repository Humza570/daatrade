<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BlogCategory;

use App\Models\BlogPost;
class BlogSubCategory extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function blogparentcategory()
    {
        //return $this->hasOne(BlogCategory::class,'id','parent_category');
        return $this->belongsTo(BlogCategory::class,'parent_category','id');

    }
    public function posts()
    {
        return $this->hasMany(BlogPost::class,'category_id','id');
    }
}
