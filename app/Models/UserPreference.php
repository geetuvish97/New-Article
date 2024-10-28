<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_preferences';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_uuid',
        'min_price',
        'max_price',
        'min_area_in_sqft',
        'max_area_in_sqft',
        'is_off_plan_condition',
        'is_ready_condition',
        'is_residential_type',
        'is_commercial_type',
        'min_bedrooms',
        'max_bedrooms',
        'min_bathrooms',
        'max_bathrooms',
        'is_fully_furnished',
        'is_semi_furnished',
        'is_unfurnished',
        'is_builder',
        'is_sms_notification',
        'is_email_notification',
        'is_whatsapp_notification'
    ];
}
