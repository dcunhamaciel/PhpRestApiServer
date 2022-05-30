<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function getAllStudents() 
    {
        $students = Student::orderBy('id')->get()->toJson(JSON_PRETTY_PRINT);

        return response($students, 200);    
    }
  
    public function createStudent(Request $request) 
    {
        $student = new Student;
        $student->name = $request->name;
        $student->course = $request->course;
        $student->save();

        return response()->json([
            "message" => "Student record created"
        ], 201);
    }
  
    public function getStudent($id) 
    {
        $student = Student::find($id);

        if (isset($student)) {            
            return response($student->toJson(JSON_PRETTY_PRINT), 200);
        } else {
            return response()->json([
              "message" => "Student not found"
            ], 404);
        }
    }
  
    public function updateStudent(Request $request, $id) 
    {
        $student = Student::find($id);

        if (isset($student)) {
            $student->name = is_null($request->name) ? $student->name : $request->name;
            $student->course = is_null($request->course) ? $student->course : $request->course;
            $student->save();
    
            return response()->json([
                "message" => "Student updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Student not found"
            ], 404);
        }
    }
  
    public function deleteStudent($id) 
    {
        $student = Student::find($id);

        if (isset($student)) {
            $student->delete();

            return response()->json([
                "message" => "Student deleted"
              ], 202);
        } else {
            return response()->json([
                "message" => "Student not found"
            ], 404);
        }
    }
}
