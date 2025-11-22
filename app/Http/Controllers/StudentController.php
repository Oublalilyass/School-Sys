<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student;
use App\Models\classes;
use App\Http\Resources\StudentResource;
use App\Http\Resources\ClassesResource;
use App\Http\Requests\StudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Database\Eloquent\Builder;


class StudentController extends Controller
{
  public function index(Request $request)
{
    $studentsQuery = student::search($request);

    return inertia(
        'Students/Index',
        [
            'students' => StudentResource::collection(
                $studentsQuery->paginate(10)->appends($request->all())
            ),
            'classes' => ClassesResource::collection(classes::all()),
            'search' => $request->search ?? '',
            'class_id' => $request->class_id ?? '',
        ]
    );
}

    public function create()
    {
        $classesResource = ClassesResource::collection(classes::all());
        return inertia(
            'Students/Create',
            [
                'classes' => $classesResource,
            ]
        );
    }

    public function store(StudentRequest $request)
    {
        // Validation by Ressource
        $validated = $request->validated();
        //create in student 
        $student = student::create($validated);
        //return index
        return redirect()->route('students.index')
            ->with('success', 'Student created successfully!');
    }


    public function edit(Student $student)
    {
        $classes = ClassesResource::collection(Classes::all());
        return inertia('Students/Edit', [
            'student' => StudentResource::make($student),
            'classes' => $classes
        ]);
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {

        $student->update($request->validated());

        return redirect()->route('students.index')
            ->with('success', 'Student update successfully!');
    }


    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->back()->with('success', 'Student deleted successfully.');
    }
}
