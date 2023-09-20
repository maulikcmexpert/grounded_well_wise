<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient_discharge_master extends Model
{

    protected $fillable = [
        'patient_id',
        'discharge_date',
        'discharge_report',
    ];
    use HasFactory;
}
