<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'logo',
        'category',
        'start_date',
        'end_date',
        'views',
        'photo',
        'status',
        'registration_required',
    ];

    public function scopeFilter($query)
    {
        if (request()->has('search')) {
            return $query->where('name', 'like', '%' . request('search') . '%');
        }
    }

    public function registrant()
    {
        if (!$this->registration_required) return false;
        return $this->hasMany(EventRegistrant::class);
    }

    public function getStatus($type = 'status')
    {
        $now = now()->format('Y-m-d');
        $data = [
            'color' => 'bg-sky-500',
            'status' => 'Upcoming'
        ];

        if ($this->start_date < $now && $this->end_date > $now) {
            $data = [
                'color' => 'bg-yellow-500',
                'status' => 'Ongoing'
            ];
        }

        if ($this->end_date < $now) {
            $data = [
                'color' => 'bg-red-500',
                'status' => 'Finished'
            ];
        }

        return $data[$type];
    }
}
