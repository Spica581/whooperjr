 <?php

namespace App\Http\Controllers;

use App\Models\GeneralInformation;
use App\Http\Requests\StoreGeneralInfoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $students = GeneralInformation::with(['familyBackground', 'medicalBackground'])->get();
        return response()->json(['success' => true, 'data' => $students]);
    }

    public function store(StoreGeneralInfoRequest $request)
    {
        $validated = $request->validated();
        $validated['Password'] = Hash::make($validated['Password']);

        $student = GeneralInformation::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Student created successfully.',
            'data' => $student
        ], 201);
    }

    public function show($id)
    {
        $student = GeneralInformation::with([
            'familyBackground', 'educationalBackground', 'extracurriculars', 
            'medicalBackground', 'otherInformation'
        ])->findOrFail($id);

        return response()->json(['success' => true, 'data' => $student]);
    }

    public function destroy($id)
    {
        GeneralInformation::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Deleted.']);
    }
}