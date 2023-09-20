<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Admin\Group;

class GroupDoctorAssignment extends Model
{
    use HasFactory;

    protected $table = 'group_doctor_assignments';
    protected $fillable = [
        'doctor_id',
        'group_id',
        'start_time',
        'end_time'
    ];

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
