<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Student;


Route::get('/get-students', function () {
    $studentCount = count(Student::all());

    return response()->json(['student_count' => $studentCount]);
});
