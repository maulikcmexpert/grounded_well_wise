<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Api\patientDetails;
use App\Models\DoctorDetails;
use App\Models\doctorReferral;
use App\Models\Admin\GroupDoctorAssignment;
use App\Models\GroupPatientAssignment;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Models\Role;
use App\Models\Admin\PatientApoms;
use App\Models\Admin\Attendance;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'id';
    protected $fillable = [
        'first_name',
        'last_name',
        'identity_number',
        'image',
        'role_id',
        // 'email',
        'password',
        'status'
    ];



    public function patientDetails()
    {
        return $this->hasOne(patientDetails::class, 'user_id');
    }


    // public function referringProviders()
    // {
    // return $this->hasMany(patientDetails::class, 'referring_provider');
    // }


    public function doctorDetails()
    {
        return $this->hasOne(DoctorDetail::class, 'doctor_id', 'id');
    }

    public function groupPatientAssignments()
    {
        return $this->hasMany(GroupPatientAssignment::class, 'patient_id');
    }

    public function groupByDoctorAssignments()
    {
        return $this->hasMany(GroupPatientAssignment::class, 'doctor_id');
    }


    public function groupDoctorAssignments()
    {
        return $this->hasMany(GroupDoctorAssignment::class, 'doctor_id');
    }




    // Relationship with referring providers

    public function doctorReferring()
    {
        return $this->hasMany(doctorReferral::class, 'referring_doctor_id');
    }

    public function doctorReferred()
    {
        return $this->hasMany(doctorReferral::class, 'referred_doctor_id');
    }

    public function refferTopatent()
    {
        return $this->hasMany(doctorReferral::class, 'patient_id');
    }


    public function PatientApoms()
    {
        return $this->hasMany(PatientApoms::class, 'patient_id');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'patient_id');
    }

    public function Role()
    {
        return $this->belongsTo(Role::class);
    }



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
