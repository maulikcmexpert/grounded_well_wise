<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class patientDetails extends Model
{
    protected $table = 'patient_details';

    protected $fillable = [
        // 'user_id',
        // 'passport_SAID',
        // 'identification_number',
        // 'date_of_birth',
        // 'referring_provider',
        // 'next_of_kin',
        // 'name',
        // 'surname',
        // 'contact_number',
        // 'alternative_contact_number',
        // 'physical_address',
        // 'complex_name',
        // 'unit_no',
        // 'city',
        // 'country',
        // 'language',
        // 'postal_code'
    ];
    use HasFactory;




    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship with referring provider
    // public function referringProvider()
    // {
    //     return $this->belongsTo(User::class, 'referring_provider');
    // }
}
