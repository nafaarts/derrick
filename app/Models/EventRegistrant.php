<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRegistrant extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'name',
        'email',
        'education_level',
        'current_status',
        'resident',
        'institution',
        'major',
        'phone',
        'remark',
    ];

    public function scopeFilter($query)
    {
        if (request()->has('search')) {
            return $query->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('email', 'like', '%' . request('search') . '%')
                ->orWhere('phone', 'like', '%' . request('search') . '%');
        }
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
