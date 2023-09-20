<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\RasRating;
use App\Models\Admin\PatientRasMaster;
use App\Models\Admin\rasQuestionCategories;

class RasQuestion extends Model
{

    protected $table = 'ras_questions';

    protected $fillable = [
        'subscale',
        'question',
    ];
    use HasFactory;

    public function ras_rating()
    {
        return $this->hasMany(RasRating::class);
    }

    public function patient_ras_master()
    {
        return $this->hasMany(PatientRasMaster::class, 'question_id');
    }

    public function ras_question_categories()
    {
        return $this->belongsTo(rasQuestionCategories::class, 'subscale');
    }
}
