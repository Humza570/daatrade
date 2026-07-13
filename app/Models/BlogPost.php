<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\SubCategory;

class BlogPost extends Model
{
    use HasFactory;
    protected $fillable = [
        'author_id',
        'category_id',
        'post_title',
        'post_content',
        'post_slug',
        'featured_image'
    ];
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'category_id');
    }
    public function scopeSearch($query, $term)
    {
        $term = "%$term%"; // Add the closing '%' character
       
        $query->where(function ($query) use ($term) {
            $query->where('post_title', 'LIKE', $term);
        });
    }
}
