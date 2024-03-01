<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        // 'name',
        // 'email',
        // 'password',
        'name',
        'email',
        'password',
        'admin',
        'active',
        'membership_id',
        'membership_started',
        'membership_expired',
        'token',
        'd_code',
        'ban',
        'note',
        'username'
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
    ///////////
    public function profile()
    {

        return $this->hasOne('App\Profile');
    }
    public function testimonial()
    {

        return $this->hasOne('App\Testimonial');
    }
    public function membership()
    {

        return $this->belongsTo('App\Membership');
    }
    public function deposits()
    {

        return $this->hasMany('App\Deposit');
    }
    public function orders()
    {

        return $this->hasMany('App\Order');
    }
    public function ptcs()
    {

        return $this->hasMany('App\Ptc');
    }
    public function links()
    {

        return $this->hasMany('App\Link');
    }
    public function shares()
    {

        return $this->hasMany('App\Share');
    }
    public function adverts()
    {

        return $this->hasMany('App\Ptc');
    }

    public function supports()
    {

        return $this->hasMany('App\Support');
    }
    public function discussions()
    {

        return $this->hasMany('App\Discussion');
    }

    public function withdraws()
    {

        return $this->hasMany('App\Withdraw');
    }
    public function Cryptos()
    {

        return $this->hasMany('App\Crypto');
    }
    public function invests()
    {

        return $this->hasMany('App\Invest');
    }
    public function videos()
    {

        return $this->hasMany('App\Video');
    }

    public function reflink()
    {

        return $this->hasOne('App\Reflink');
    }
    public function kycs()
    {

        return $this->hasMany('App\Kyc');
    }
    public function interests()
    {

        return $this->hasMany('App\Interest');
    }
    public function interestlogs()
    {

        return $this->hasMany('App\InterestLog');
    }
    public function kyc2s()
    {

        return $this->hasMany('App\Kyc2');
    }
    public function userlogs()
    {

        return $this->hasMany('App\UserLog');
    }
    public function transferlogs()
    {

        return $this->hasMany('App\TransferLog');
    }
    public function verified()
    {

        return $this->active === 1;
    }

    public function sendVerificationEmail()
    {

        return $this->notify(new MustVerifyEmail($this));
    }
    public function scopeSearch($query, $s)
    {


        return $query->where('email', 'like', '%' . $s . '%')
            ->orWhere('name', 'like', '%' . $s . '%');
    }
}
