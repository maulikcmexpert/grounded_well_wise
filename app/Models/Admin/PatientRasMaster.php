<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\RasRating;
use App\Models\Admin\RasQuestion;

class PatientRasMaster extends Model
{

    protected $table = "patient_ras_masters";
    use HasFactory;

    public function ras_question()
    {
        return $this->belongsTo(RasQuestion::class, 'question_id');
    }

    public function ras_rating()
    {
        return $this->belongsTo(RasRating::class, 'answer_id');
    }
}
