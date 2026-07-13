<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class AssignInquiry extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function assignedSupplier()
    {
        return $this->belongsTo(User::class, 'sid');
    }
}
