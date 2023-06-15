<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\UserProfile;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'privilege',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->morphOne(UserProfile::class,'profileable');
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function book()
    {
        return $this->hasOne(Book::class);
    }
    
    public function orders()
    {
        return $this->hasManyThrough(Order::class,Book::class,'user_id','book_id');
    }

    public function order()
    {
        return $this->hasOneThrough(Order::class,Book::class,'user_id','book_id');
    }

}
