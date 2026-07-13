<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Product;
use App\Models\Country;
use App\Models\BlogPost;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'contact_numer',
        'password',
        'country',
        'city',
        'role',
        'company_name',
        'company_registration_number',
        'status',
        'username',
        'super', 'avatar', 'preferences', 'last_login', 'biogarphy', 'blocked', 'direct_publish'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function products()
    {
        return $this->hasMany(Product::class, 'uid', 'id');
    }

    /**
     * Summary of country
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usercountry()
    {
        return $this->hasOne(Country::class, 'id', 'country');
    }
    public function posts()
    {
        return $this->hasMany(BlogPost::class, 'author_id', 'id');
    }
    public function membership()
    {
        return $this->hasOne(Membership::class, 'user_id', 'id');
    }
    public function membershiporder()
    {
        return $this->haveMany(MembershipOrder::class, 'user_id', 'id');
    }
}
