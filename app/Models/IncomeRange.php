<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class IncomeRange extends Model
{
    use HasFactory;

    protected $table = "income_ranges";

    protected $fillable = [
        'title',
        'description',
        'min',
        'max',
        'currency',
        'status'
    ];
}
