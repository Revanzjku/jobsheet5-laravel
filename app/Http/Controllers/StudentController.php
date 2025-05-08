<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\StudentParent;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $query = Student::with('classroom', 'studentParent');
        $title = 'Data Siswa';

        if($search)
        {
            $query->where('student_name', 'like', "%{$search}%")
                    ->orWhere('NIS', 'like', "%{$search}%")
                    ->orWhere('gender', 'like', "%{$search}%")
                    ->orWhere('place_of_birth', 'like', "%{$search}%")
                    ->orWhere('date_of_birth', 'like', "%{$search}%")
                    ->orWhereHas('classroom', function($q) use ($search) {
                        $q->where('class_name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('studentParent', function($q) use ($search) {
                        $q->where('parent_name', 'like', "%{$search}%");
                    });
        }

        $students = $query->orderBy('student_name')->paginate(10);

        session(['previous_url' => request()->fullUrl()]);

        return view('siswa.index', compact('students', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classrooms = Classroom::all();
        $parents = StudentParent::all();
        $title = 'Tambah Data Siswa';
        $student = null;

        return view('siswa.siswa_form', compact('classrooms', 'parents', 'title', 'student'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        Student::create($request->all());

        return redirect()->route('student.index')->with('success', 'Siswa baru berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $classrooms = Classroom::all();
        $parents = StudentParent::all();
        $title = 'Edit Data Siswa';

        return view('siswa.siswa_form', compact('student', 'classrooms', 'parents', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, Student $student)
    {
        $student->update($request->all());
        
        return redirect(session('previous_url', route('student.index')))->with('success', 'Data siswa berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('student.index')->with('success', 'Data siswa berhasil dihapus!');
    }
}
