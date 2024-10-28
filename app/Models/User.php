<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'email_verification_token',
        'otp'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'mobile_verified_at' => 'datetime',
    ];
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function userDetail()
    {
        return $this->hasOne(UserDetail::class, 'user_uuid', 'uuid');
    }

    public function userPreferences()
    {
        return $this->hasOne(UserPreference::class, 'user_uuid', 'uuid');
    }
    public function userPropertyTypePreferences()
    {
        return $this->hasMany(UserPropertyTypePreference::class, 'user_uuid', 'uuid');
    }
    public function userLocationPreferences()
    {
        return $this->hasMany(UserLocationPreference::class, 'user_uuid', 'uuid');
    }
    public function userLoginActivities()
    {
        return $this->hasMany(UserLoginActivity::class, 'user_uuid', 'uuid');
    }
}
