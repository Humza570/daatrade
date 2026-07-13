<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Country extends Model
{
    use HasFactory;
    public function country()
    {
        return $this->belongsTo(User::class, 'country', 'id');
    }
}
