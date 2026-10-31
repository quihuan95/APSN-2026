<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'title',
        'title_other',
        'full_name',
        'gender',
        'date_of_birth',
        'economy',
        'organization',
        'position',
        'attending_as',
        'nationality',
        'passport_type',
        'passport_number',
        'passport_expiry',
        'passport_copy_path',
        'visa_status',
        'visa_status_other',
        'sessions',
        'arrival_at',
        'arrival_flight',
        'departure_at',
        'departure_flight',
        'hotel_name',
        'email',
        'phone',
        'dietary',
        'dietary_other',
        'accessibility',
        'consent',
    ];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
            'passport_expiry' => 'date',
            'sessions' => 'array',
            'arrival_at' => 'datetime',
            'departure_at' => 'datetime',
            'consent' => 'boolean',
        ];
    }
};
