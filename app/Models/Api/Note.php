<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'session_id',
        'patient_id',
        'title',
        'note'
    ];

    use HasFactory;
}
