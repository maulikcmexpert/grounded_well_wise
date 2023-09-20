<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class DoctorDetail extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'doctor_id ',
        'contact_number',
        'date_of_birth',
        'gender',
        'profession',
    ];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'doctor_id', 'id');
    }
}
