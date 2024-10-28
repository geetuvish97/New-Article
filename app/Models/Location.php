<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $table = "locations";

    protected $fillable = [
        'name',
        'description',
        'longitude',
        'latitude',
        'location_type',
        'path',
        'path_name'
    ];

    
}
