<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\RasQuestion;

class rasQuestionCategories extends Model
{
    protected $table = "ras_question_categories";
    use HasFactory;

    public function ras_questions()
    {
        return $this->hasMany(RasQuestion::class, 'subscale');
    }
}
