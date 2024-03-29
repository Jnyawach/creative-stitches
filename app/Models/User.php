<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles, HasPermissions,Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'last_name'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'stripe_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function verifiable(){
        return $this->morphMany(Verify::class, 'verifiable');
    }

    public function address(){
        return $this->hasOne(Address::class);
    }

    public function wishlists(){
        return $this->hasMany(Wishlist::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function payments(){
        return $this->hasMany(Payment::class);
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function totalSpent(){
        return $this->payments()->sum('total');
    }

}
