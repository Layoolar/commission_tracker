<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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


    public function referral()
    {
        return $this->belongsTo(User::class, 'referred_by', 'id');
    }

    public function referred()
    {
        // return User::whereReferredBy($this->id);
        return User::where('referred_by', $this->id);
    }

    // $user->referral->number_reffered($date);

    public function number_referred($date)
    {
        return User::find($this->id)->referred()->where('enrolled_date', '<=', $date)->count();
    }

    public function usercategory()
    {
        return $this->hasOne(UserCategory::class, 'user_id', 'id');
    }

    public function hasRole($name)
    {
        return (bool) $this->usercategory->category->name == $name;
    }

    public function isDistributor()
    {
        return $this->hasRole('distributor');
    }
    // $user->hasRole('distributor');

    // $user->referral->isDistributor();


}
