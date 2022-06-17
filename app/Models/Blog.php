<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'headline',
        'content',
        'image',
        'image_link',
        'status',
        'views',
        'user_id'
    ];

    protected $with = ['user'];

    function user()
    {
        return $this->belongsTo(User::class);
    }
}
