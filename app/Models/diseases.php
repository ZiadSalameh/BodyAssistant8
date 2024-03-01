<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class diseases extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'joint_pain',
        'back_pain',
        'neck_pain',
        'rheumatism',
        'nerve_disease',
    ];
    //////////////////////////////////////////

    ///////////////////////////////////////////
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
