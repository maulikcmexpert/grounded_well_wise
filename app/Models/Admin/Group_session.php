<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Group;

class Group_session extends Model
{

    protected $fillable = [
        'session_name',
        'session_details',
        'group_id',
        'session_date'
    ];
    use HasFactory;
    protected $primaryKey = "id";

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'session_id');
    }
}
