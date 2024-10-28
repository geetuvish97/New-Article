<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPropertyView extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_property_views';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_uuid',
        'property_id',
        'data_json',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_uuid', 'uuid');
    }
}