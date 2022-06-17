<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registrant extends Model
{
    use HasFactory;

    protected $fillable = [
        'competition_id',
        'user_id',
        'registration_number',
        'team_name',
        'phone_number',
        'major',
        'university',
        'id_card',
        'student_card',
    ];

    public function scopeFilter($query)
    {
        if (request()->has('search')) {
            return $query->where('team_name', 'like', '%' . request('search') . '%')
                ->orWhere('university', 'like', '%' . request('search') . '%')
                ->orWhere('phone_number', 'like', '%' . request('search') . '%')
                ->orWhere('registration_number', 'like', '%' . request('search') . '%');
        }
    }

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function members()
    {
        return $this->hasMany(RegistrantMember::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function isPaid()
    {
        return $this->transactions->whereIn('transaction_status', ['settlement', 'capture'])->count() > 0;
    }

    public function latestPayment()
    {
        return $this->transactions()->latest()->first();
    }
}
