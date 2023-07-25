<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'name',
        'email',
        'password',
        'phone',
        'country_id',
        'state_id',
        'city',
        'sponser_code',
        'direct_group',
        'total_group',
        'total_group_active',
        'total_group_deposite',
        'total_deposite',
        'total_income',
        'total_withdraw',
        'current_withdraw_request',
        'status',
        'avatar',
        'is_active',
        'date_of_joning',
        'email_verified_at',
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
    
    protected $dates = ['deleted_at'];

    public function getAvatarURLAttribute()
    {
        return $this->attributes['avatar_url'] = $this->avatar ? Storage::url($this->avatar) : null;
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function paymentRequest()
    {
        return $this->hasMany(PaymentRequest::class);
    }

    public function passbook()
    {
        return $this->hasMany(Passbook::class);
    }
    
}
