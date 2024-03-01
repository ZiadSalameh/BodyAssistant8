<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class personal_inforamtion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'age',
        'weight',
        'height',
        'gender',
        'activity_level',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
