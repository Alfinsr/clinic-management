<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'age',
        'address',
        'gender',
        'phone_number',
        'birthday'
    ];

    public function patientRecords()
    {
        return $this->hasMany(PatientRecord::class);
    }
}
