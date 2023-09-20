<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\RasQuestion;
use App\Models\Admin\PatientRasMaster;

class RasRating extends Model
{
    protected $table = 'ras_ratings';
    use HasFactory;

    public function ras_question()
    {
        return $this->belongsTo(RasQuestion::class);
    }

    public function patient_ras_master()
    {
        return $this->hasMany(PatientRasMaster::class, 'answer_id');
    }
}
