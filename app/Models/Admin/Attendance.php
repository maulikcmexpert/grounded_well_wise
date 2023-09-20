<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Admin\Group_session;

class Attendance extends Model
{
    use HasFactory;

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function group_session()
    {
        return $this->belongsTo(Group_session::class, 'session_id');
    }
}
