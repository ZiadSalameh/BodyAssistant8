<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class meals extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'calories',
        'protein',
        'carbohydrates',
        'fat',
    ];
}
