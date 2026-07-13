<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\AssignInquiry;
class Inquiry extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'cid');
    }
    public function assignedInquiry()
    {
        return $this->hasOne(AssignInquiry::class, 'inquiryid');
    }
}
