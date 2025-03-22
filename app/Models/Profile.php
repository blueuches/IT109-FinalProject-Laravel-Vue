<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'profile_picture', 
        'cover_photo', 
        'bio'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
