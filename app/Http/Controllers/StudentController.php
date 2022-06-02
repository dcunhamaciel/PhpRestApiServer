<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class StudentController extends Controller
{
    public function getAllStudents(): JsonResponse
    {
        $students = Student::orderBy('id')->get();

        $httpStatusCode = empty($students) 
            ? Response::HTTP_NO_CONTENT 
            : Response::HTTP_OK;

        return response()->json($students, $httpStatusCode);
    }
  
    public function createStudent(Request $request): JsonResponse
    {
        $this->validateRequest($request);
        
        $student = new Student;
        $student->name = $request->name;
        $student->course = $request->course;
        $student->save();

        return response()->json(["message" => "Student record created"], Response::HTTP_CREATED);
    }
  
    public function getStudent(int $id): JsonResponse
    {
        $student = Student::find($id);

        if (empty($student)) {            
            return response()->json(["message" => "Student not found"], Response::HTTP_NOT_FOUND);
        }

        return response()->json($student, Response::HTTP_OK);
    }
  
    public function updateStudent(Request $request, int $id): JsonResponse
    {
        $this->validateRequest($request);
        
        $student = Student::find($id);

        if (empty($student)) {
            return response()->json(["message" => "Student not found"], Response::HTTP_NOT_FOUND);
        }

        $student->name = $request->name;
        $student->course = $request->course;
        $student->save();

        return response()->json(["message" => "Student updated successfully"], Response::HTTP_OK);
    }
  
    public function deleteStudent(int $id): JsonResponse
    {
        $student = Student::find($id);

        if (empty($student)) {
            return response()->json(["message" => "Student not found"], Response::HTTP_NOT_FOUND);
        }

        $student->delete();

        return response()->json(["message" => "Student deleted"], Response::HTTP_ACCEPTED);        
    }

    private function validateRequest(Request $request): void 
    {
        $rules = [
            'name' => 'required|string|max:60',
            'course' => 'required|string|max:60'
        ];
        
        $feedback = [
            'required' => 'O campo :attribute é obrigatório',
            'name.max' => 'O campo name deve ter no máximo 60 caracteres',
            'course.max' => 'O campo course deve ter no máximo 60 caracteres',
            'name.string' => 'O campo name deve ser string',
            'course.string' => 'O campo course deve ser string'
        ];

        $request->validate($rules, $feedback);
    }
}
