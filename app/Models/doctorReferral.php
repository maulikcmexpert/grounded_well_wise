<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class doctorReferral extends Model
{
    use HasFactory;

    public function refferingDoctor()
    {
        return $this->belongsTo(User::class, 'referring_doctor_id');
    }

    public function referredDoctor()
    {
        return $this->belongsTo(User::class, 'referred_doctor_id');
    }

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
}
