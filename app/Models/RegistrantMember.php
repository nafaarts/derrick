<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrantMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'registrant_id',
        'name',
        'email',
        'phone_number',
        'major',
        'id_card',
        'student_card',
        'photo',
    ];

    public function scopeFilter($query)
    {
        if (request()->has('search')) {
            return $query->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('email', 'like', '%' . request('search') . '%')
                ->orWhere('phone_number', 'like', '%' . request('search') . '%')
                ->orWhere('major', 'like', '%' . request('search') . '%');
        }
    }

    public function registrant()
    {
        return $this->belongsTo(Registrant::class);
    }
}
