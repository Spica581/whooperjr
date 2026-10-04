<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGeneralInfoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'CampusID'      => 'required|exists:CAMPUS,CampusID',
            'StudentNo'     => 'required|string|max:50|unique:GENERAL_INFORMATION,StudentNo',
            'Program'       => 'required|exists:PROGRAM,ProgramID',
            'YearSecID'     => 'required|exists:YEAR_SECTION,YearSecID',
            'Surname'       => 'required|string|max:50',
            'GivenName'     => 'required|string|max:50',
            'MiddleName'    => 'required|string|max:50',
            'Nickname'      => 'nullable|string|max:50',
            'Age'           => 'required|integer|min:1',
            'SexID'         => 'required|exists:SEX,SexID',
            'CivilStatusID' => 'required|exists:CIVIL_STATUS,CivilStatusID',
            'Religion'      => 'required|string|max:20',
            'BDate'         => 'required|date',
            'BirthPlace'    => 'required|string|max:100',
            'Citizenship'   => 'required|string|max:50',
            'Region'        => 'required|string|max:50',
            'Languages'     => 'required|string|max:100',
            'IndiMem'       => 'nullable|string|max:100',
            'CurrRes'       => 'required|exists:CURRENT_RESIDENCY,CurrRes',
            'PresentAdd'    => 'required|string|max:200',
            'PermanentAdd'  => 'required|string|max:200',
            'Contact'       => 'required|string|max:20',
            'Email'         => 'required|email|max:50|unique:GENERAL_INFORMATION,Email',
            'ProfileLink'   => 'required|string|max:100',
            'Password'      => 'required|string|min:8', // Only required on creation
        ];
    }
}