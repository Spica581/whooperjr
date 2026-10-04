<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FamilyBackground extends Model
{
    protected $table = 'FAMILY_BACKGROUND';
    protected $primaryKey = 'FamBGID';
    public $timestamps = false; // Diagram doesn't specify timestamps
    protected $guarded = ['FamBGID'];

    protected $casts = [
        'FatherBirthdate' => 'date',
        'MotherBirthdate' => 'date',
        'is_SoloParent' => 'boolean'
    ];
}