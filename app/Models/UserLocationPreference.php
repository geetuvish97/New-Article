<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserLocationPreference extends Model
{
    use HasFactory;

    protected $table = "user_location_preferences";

    protected $fillable = [
        'user_uuid',
        'location_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_uuid', 'uuid');
    }
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }
}
