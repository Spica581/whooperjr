<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class GeneralInformation extends Authenticatable
{
    use HasApiTokens;

    protected $table = 'GENERAL_INFORMATION';
    protected $primaryKey = 'GenID';
    
    protected $guarded = ['GenID'];

    protected $hidden = [
        'Password',
    ];

    public function getAuthPassword()
    {
        return $this->Password;
    }

    // Relationships
    public function familyBackground() {
        return $this->hasOne(FamilyBackground::class, 'StudentNo', 'StudentNo');
    }

    public function educationalBackground() {
        return $this->hasOne(EducationalBackground::class, 'StudentNo', 'StudentNo');
    }

    public function extracurriculars() {
        return $this->hasMany(Extracurricular::class, 'StudentNo', 'StudentNo');
    }

    public function medicalBackground() {
        return $this->hasOne(MedicalBackground::class, 'StudentNo', 'StudentNo');
    }

    public function otherInformation() {
        return $this->hasOne(OtherInformation::class, 'StudentNo', 'StudentNo');
    }
}