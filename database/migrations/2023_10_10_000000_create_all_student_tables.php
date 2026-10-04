<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. LOOKUP TABLES
        Schema::create('CAMPUS', function (Blueprint $table) {
            $table->tinyIncrements('CampusID');
            $table->string('CampusName', 100);
        });

        Schema::create('PROGRAM', function (Blueprint $table) {
            $table->tinyIncrements('ProgramID');
            $table->string('ProgramName', 100);
        });

        Schema::create('YEAR_SECTION', function (Blueprint $table) {
            $table->tinyIncrements('YearSecID'); // Replaced & for ORM compatibility
            $table->string('YSName', 100);
        });

        Schema::create('SEX', function (Blueprint $table) {
            $table->tinyIncrements('SexID');
            $table->string('SexName', 100);
        });

        Schema::create('CIVIL_STATUS', function (Blueprint $table) {
            $table->tinyIncrements('CivilStatusID');
            $table->string('CSName', 100);
        });

        Schema::create('CURRENT_RESIDENCY', function (Blueprint $table) {
            $table->tinyIncrements('CurrRes');
            $table->string('CurrResName', 100);
        });

        Schema::create('MARITAL_STATUS', function (Blueprint $table) {
            $table->tinyIncrements('MaritalStatusID');
            $table->string('MSName', 100);
        });

        Schema::create('LIVING_ARRANGEMENT', function (Blueprint $table) {
            $table->tinyIncrements('LivArrangeID');
            $table->string('LivArrangeName', 100);
        });

        Schema::create('TOTAL_INCOME', function (Blueprint $table) {
            $table->tinyIncrements('TotalIncID');
            $table->string('TotalIncName', 100);
        });

        Schema::create('SIBLINGS', function (Blueprint $table) {
            $table->tinyIncrements('SiblingID');
            $table->string('SiblingName', 100)->nullable();
            $table->string('SiblingAge', 100)->nullable();
            $table->string('SiblingOccupation', 100)->nullable();
            $table->string('SiblingSchool', 100)->nullable();
            $table->string('SiblingContact', 100)->nullable();
        });

        Schema::create('POSITION', function (Blueprint $table) {
            $table->tinyIncrements('PositionID');
            $table->string('PositionName', 50)->nullable();
        });

        Schema::create('SCHOOL_TYPE', function (Blueprint $table) {
            $table->id('SchoolTypeID');
            $table->string('STName', 10)->nullable();
            $table->boolean('is_type')->nullable();
        });

        // 2. MAIN TABLE
        Schema::create('GENERAL_INFORMATION', function (Blueprint $table) {
            $table->id('GenID');
            $table->unsignedTinyInteger('CampusID');
            $table->string('StudentNo', 50)->unique();
            $table->unsignedTinyInteger('Program');
            $table->unsignedTinyInteger('YearSecID');
            $table->string('Surname', 50);
            $table->string('GivenName', 50);
            $table->string('MiddleName', 50);
            $table->string('Nickname', 50)->nullable();
            $table->unsignedTinyInteger('Age');
            $table->unsignedTinyInteger('SexID'); // Normalized to match PK
            $table->unsignedTinyInteger('CivilStatusID'); // Normalized
            $table->string('Religion', 20);
            $table->date('BDate');
            $table->string('BirthPlace', 100);
            $table->string('Citizenship', 50);
            $table->string('Region', 50);
            $table->string('Languages', 100);
            $table->string('IndiMem', 100)->nullable();
            $table->unsignedTinyInteger('CurrRes');
            $table->string('PresentAdd', 200);
            $table->string('PermanentAdd', 200);
            $table->string('Contact', 20);
            $table->string('Email', 50)->unique();
            $table->string('ProfileLink', 100);
            $table->string('Password', 255); // Added for Sanctum

            // FK Constraints
            $table->foreign('CampusID')->references('CampusID')->on('CAMPUS')->cascadeOnUpdate();
            $table->foreign('Program')->references('ProgramID')->on('PROGRAM')->cascadeOnUpdate();
            $table->foreign('YearSecID')->references('YearSecID')->on('YEAR_SECTION')->cascadeOnUpdate();
            $table->foreign('SexID')->references('SexID')->on('SEX')->cascadeOnUpdate();
            $table->foreign('CivilStatusID')->references('CivilStatusID')->on('CIVIL_STATUS')->cascadeOnUpdate();
            $table->foreign('CurrRes')->references('CurrRes')->on('CURRENT_RESIDENCY')->cascadeOnUpdate();
        });

        // 3. DEPENDENT TABLES
        Schema::create('FAMILY_BACKGROUND', function (Blueprint $table) {
            $table->id('FamBGID');
            $table->string('StudentNo', 50);
            $table->unsignedTinyInteger('MaritalSatusID');
            $table->unsignedTinyInteger('LivArrangeID');
            
            // Father
            $table->string('FatherName', 150)->nullable();
            $table->date('FatherBirthdate')->nullable();
            $table->string('FatherCitizenship', 20)->nullable();
            $table->string('FatherOccupation', 100)->nullable();
            $table->string('FatherHEA', 20)->nullable();
            $table->string('FatherWorkAdd', 200)->nullable();
            $table->string('FatherCPA', 200)->nullable();
            $table->string('FatherContact', 20)->nullable();

            // Mother
            $table->string('MotherName', 150)->nullable();
            $table->date('MotherBirthdate')->nullable();
            $table->string('MotherCitizenship', 20)->nullable();
            $table->string('MotherOccupation', 100)->nullable();
            $table->string('MotherHEA', 20)->nullable();
            $table->string('MotherWorkAddress', 200)->nullable();
            $table->string('MotherCPA', 200)->nullable();
            $table->string('MotherContact', 20)->nullable();

            // Guardian
            $table->string('GuardianName', 200)->nullable();
            $table->string('GuardianRelationship', 50)->nullable();
            $table->string('GuardianContact', 20)->nullable();
            $table->string('GuardianCPA', 200)->nullable();

            $table->unsignedTinyInteger('NuSiblings')->nullable();
            $table->string('BirthOrder', 5)->nullable();
            $table->unsignedTinyInteger('SiblingID')->nullable();
            
            $table->unsignedTinyInteger('TotalIncID');
            $table->string('4ps', 20)->nullable();
            $table->string('Financer', 20);
            $table->string('SpouseName', 200)->nullable();
            $table->string('SpouseContact', 20)->nullable();
            $table->string('KidsAges', 50)->nullable();
            $table->boolean('is_SoloParent');

            $table->foreign('StudentNo')->references('StudentNo')->on('GENERAL_INFORMATION')->cascadeOnDelete();
            $table->foreign('MaritalSatusID')->references('MaritalStatusID')->on('MARITAL_STATUS');
            $table->foreign('LivArrangeID')->references('LivArrangeID')->on('LIVING_ARRANGEMENT');
            $table->foreign('SiblingID')->references('SiblingID')->on('SIBLINGS');
            $table->foreign('TotalIncID')->references('TotalIncID')->on('TOTAL_INCOME');
        });

        Schema::create('EDUCATIONAL_BACKGROUND', function (Blueprint $table) {
            $table->id('EducBGID');
            $table->string('StudentNo', 50);
            $table->string('ElemName', 200);
            $table->string('ElemAdd', 200);
            $table->unsignedBigInteger('SchoolTypeID'); // Normalized to INT
            $table->smallInteger('ElemYear');
            $table->string('ElemTrack', 100);
            $table->string('HSName', 200);
            $table->string('HSAdd', 200);
            $table->smallInteger('HSYear');
            $table->string('HSTrack', 100);
            $table->string('SHSName', 200);
            $table->string('SHSAdd', 200);
            $table->smallInteger('SHSYear');
            $table->string('SHSTrack', 100);
            $table->string('CollegeName', 200);
            $table->string('CollegeAdd', 200);
            $table->smallInteger('CollegeYear');
            $table->string('CollegeTrack', 100);
            $table->string('Awards', 250)->nullable();
            $table->string('Scholarships', 100)->nullable();
            $table->boolean('is_Employed');
            $table->date('Since')->nullable();
            $table->string('Employer', 200)->nullable();

            $table->foreign('StudentNo')->references('StudentNo')->on('GENERAL_INFORMATION')->cascadeOnDelete();
            $table->foreign('SchoolTypeID')->references('SchoolTypeID')->on('SCHOOL_TYPE');
        });

        Schema::create('EXTRACURRICULAR', function (Blueprint $table) {
            $table->id('ExtID');
            $table->string('StudentNo', 50);
            $table->string('SOAName', 200)->nullable();
            $table->unsignedTinyInteger('PositionID')->nullable();
            $table->smallInteger('SOAYear')->nullable();
            $table->string('OrgName', 200)->nullable();
            $table->string('COAName', 200)->nullable();
            $table->smallInteger('COAYear')->nullable();
            $table->string('CName', 200)->nullable();

            $table->foreign('StudentNo')->references('StudentNo')->on('GENERAL_INFORMATION')->cascadeOnDelete();
            $table->foreign('PositionID')->references('PositionID')->on('POSITION');
        });

        Schema::create('MEDICAL_BACKGROUND', function (Blueprint $table) {
            $table->id('MedicalBackground');
            $table->string('StudentNo', 50);
            $table->string('Height', 10);
            $table->string('Weight', 10);
            $table->boolean('is_PWD');
            $table->string('PWDID', 50)->nullable();
            $table->string('AccExp', 100)->nullable();
            $table->string('ChronIll', 100)->nullable();
            $table->string('RecThera', 100)->nullable();
            $table->date('When')->nullable();
            $table->string('Condition', 100)->nullable();
            $table->string('Medications', 100)->nullable();

            $table->foreign('StudentNo')->references('StudentNo')->on('GENERAL_INFORMATION')->cascadeOnDelete();
        });

        Schema::create('OTHER_INFORMATION', function (Blueprint $table) {
            $table->id('OtherInfoID');
            $table->string('StudentNo', 50);
            $table->string('Interests', 300);
            $table->string('Skills', 300);
            $table->string('Hobbies', 300);
            $table->string('Goals', 100);
            $table->string('Motto', 100);
            $table->string('Trait', 200);
            $table->boolean('ExamResults');
            $table->float('LatestGPA');

            $table->foreign('StudentNo')->references('StudentNo')->on('GENERAL_INFORMATION')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('OTHER_INFORMATION');
        Schema::dropIfExists('MEDICAL_BACKGROUND');
        Schema::dropIfExists('EXTRACURRICULAR');
        Schema::dropIfExists('EDUCATIONAL_BACKGROUND');
        Schema::dropIfExists('FAMILY_BACKGROUND');
        Schema::dropIfExists('GENERAL_INFORMATION');
        // drop lookups...
        Schema::dropIfExists('SCHOOL_TYPE');
        Schema::dropIfExists('POSITION');
        Schema::dropIfExists('SIBLINGS');
        Schema::dropIfExists('TOTAL_INCOME');
        Schema::dropIfExists('LIVING_ARRANGEMENT');
        Schema::dropIfExists('MARITAL_STATUS');
        Schema::dropIfExists('CURRENT_RESIDENCY');
        Schema::dropIfExists('CIVIL_STATUS');
        Schema::dropIfExists('SEX');
        Schema::dropIfExists('YEAR_SECTION');
        Schema::dropIfExists('PROGRAM');
        Schema::dropIfExists('CAMPUS');
    }
};