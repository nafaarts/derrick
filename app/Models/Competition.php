<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'slug',
        'logo',
        'description',
        'status',
        'start_date',
        'end_date',
        'date_reg_start_first_batch',
        'date_reg_end_first_batch',
        'price_first_batch',
        'date_reg_start_second_batch',
        'date_reg_end_second_batch',
        'price_second_batch',
        'prize_pool',
        'max_member',
        'guide_file',
        'photo',
        'views',
    ];

    public function scopeFilter($query)
    {
        if (request()->has('search')) {
            return $query->where('name', 'like', '%' . request('search') . '%');
        }
    }

    public function getStatus($type = 'status')
    {
        $now = now()->format('Y-m-d');
        $data = [
            'color' => 'bg-sky-500',
            'status' => 'Upcoming'
        ];

        if ($this->start_date <= $now && $this->end_date >= $now) {
            $data = [
                'color' => 'bg-yellow-500',
                'status' => 'Ongoing'
            ];
        }

        if ($this->end_date <= $now) {
            $data = [
                'color' => 'bg-red-500',
                'status' => 'Finished'
            ];
        }

        return $data[$type];
    }

    public function getRegistrationStatus($type = 'detail')
    {
        $today = strtotime(now()->format('Y-m-d'));
        $date_reg_start_first_batch = strtotime($this->date_reg_start_first_batch);
        $date_reg_end_first_batch = strtotime($this->date_reg_end_first_batch);
        $date_reg_start_second_batch = strtotime($this->date_reg_start_second_batch);
        $date_reg_end_second_batch = strtotime($this->date_reg_end_second_batch);

        $data = [
            'detail' => 'First Batch',
            'is_open' => false,
        ];

        if ($today >= $date_reg_start_first_batch && $today <= $date_reg_end_first_batch) {
            $data = [
                'detail' => 'First Batch',
                'is_open' => true,
            ];
        }

        if ($today >= $date_reg_start_second_batch && $today <= $date_reg_end_second_batch) {
            $data = [
                'detail' => 'Second Batch',
                'is_open' => true,
            ];
        }

        if ($today > $date_reg_end_second_batch) {
            $data['detail'] = 'Second Batch';
        }

        return $data[$type];
    }

    public function getCurrentPrice()
    {
        $detail = $this->getRegistrationStatus('detail');
        if ($detail == 'Second Batch') {
            return $this->price_second_batch;
        }
        return $this->price_first_batch;
    }

    public function registrant()
    {
        return $this->hasMany(Registrant::class);
    }
}
