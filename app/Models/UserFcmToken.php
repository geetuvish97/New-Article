<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFcmToken extends Model
{
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_fcm_tokens';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'locale',
        'fcm_id',
        'device_id',
        'device_type',
        'sound_key',
        'vibrate',
        'app_sound'
    ];
}
