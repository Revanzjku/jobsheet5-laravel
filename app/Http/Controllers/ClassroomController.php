<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $query = Classroom::query();
        $title = 'Data Kelas';

        if($search){
            $query->where('class_name', 'like',  "%{$search}%");
        }

        $classrooms = $query->orderBy('class_name')->paginate(10);

        session(['previous_url' => request()->fullUrl()]);

        return view('kelas.index', compact('classrooms', 'search', 'title'));
    }

    
    public function create()
    {
        $title = 'Tambah Data Kelas';
        $classroom = null;

        return view('kelas.form', compact('title', 'classroom'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_name' => 'required|string|unique:classrooms,class_name'
        ],
        [
            'class_name.required' => 'Nama kelas harus diisi.',
            'class_name.string' => 'Nama kelas harus berupa teks.',
            'class_name.unique' => 'Nama kelas ini sudah digunakan. Silakan pilih nama kelas yang lain.'
        ]);

        Classroom::create([
            'class_name' => $request->class_name
        ]);

        return redirect()->route('classroom.index')->with('success', 'Data kelas baru berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom)
    {
        $title = 'Edit Data Kelas';

        return view('kelas.form', compact('title', 'classroom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom)
    {
        $request->validate([
            'class_name' => 'required|string|unique:classrooms,class_name,' .$classroom->id
        ],
        [
            'class_name.required' => 'Nama kelas harus diisi.',
            'class_name.string' => 'Nama kelas harus berupa teks.',
            'class_name.unique' => 'Nama kelas ini sudah digunakan. Silakan pilih nama kelas yang lain.'
        ]);

        $classroom->update(['class_name' => $request->class_name]);

        return redirect(session('previous_url', route('classroom.index')))->with('success', 'Data kelas berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        if($classroom->students()->count() > 0)
        {
            return redirect()->route('classroom.index')->with('error', 'Kelas tidak dapat dihapus karena masih diisi oleh siswa!');
        }
        $classroom->delete();

        return redirect()->route('classroom.index')->with('success', 'Data kelas berhasil dihapus!');
    }
}
