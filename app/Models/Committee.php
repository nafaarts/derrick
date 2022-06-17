<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'title', 'photo', 'status'
    ];

    public function scopeFilter($query)
    {
        if (request()->has('search')) {
            return $query->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('title', 'like', '%' . request('search') . '%');
        }
    }
}
