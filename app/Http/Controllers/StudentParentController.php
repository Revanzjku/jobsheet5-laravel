<?php

namespace App\Http\Controllers;

use App\Models\StudentParent;
use Illuminate\Http\Request;

class StudentParentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $query = StudentParent::query();
        $title = 'Data Wali Murid';

        if($search){
            $query->where('parent_name', 'like',  "%{$search}%")
                ->orWhere('contact', 'like', "%{$search}%");
        }

        $studentParents = $query->orderBy('parent_name')->paginate(10);

        session(['previous_url' => request()->fullUrl()]);

        return view('wali_murid.index', compact('studentParents', 'search', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Data Wali Murid';
        $studentParent = null;

        return view('wali_murid.wali_form', compact('title', 'studentParent'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'parent_name' => 'required|string|max:255',
            'contact' => 'required|max:20|unique:student_parents,contact'
        ],
        [
            'parent_name.required' => 'Nama orang tua tidak boleh kosong.',
            'parent_name.string' => 'Nama orang tua harus berupa teks.',
            'parent_name.max' => 'Nama orang tua maksimal 255 karakter.',
            
            'contact.required' => 'Kontak tidak boleh kosong.',
            'contact.max' => 'Kontak maksimal 20 karakter.',
            'contact.unique' => 'Kontak ini sudah terdaftar pada sistem.'
        ]);

        StudentParent::create($request->all());

        return redirect()->route('studentParent.index')->with('success', 'Data wali murid baru berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentParent $studentParent)
    {
        $title = 'Edit Data Wali Murid';

        return view('wali_murid.wali_form', compact('title', 'studentParent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudentParent $studentParent)
    {
        $request->validate([
            'parent_name' => 'required|string|max:255',
            'contact' => 'required|max:20|unique:student_parents,contact,' .$studentParent->id
        ],
        [
            'parent_name.required' => 'Nama orang tua tidak boleh kosong.',
            'parent_name.string' => 'Nama orang tua harus berupa teks.',
            'parent_name.max' => 'Nama orang tua maksimal 255 karakter.',
            
            'contact.required' => 'Kontak tidak boleh kosong.',
            'contact.max' => 'Kontak maksimal 20 karakter.',
            'contact.unique' => 'Kontak ini sudah terdaftar pada sistem.'
        ]);

        $studentParent->update($request->all());

        return redirect(session('previous_url', route('studentParent.index')))->with('success', 'Data wali murid berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentParent $studentParent)
    {
        if($studentParent->students()->count() > 0)
        {
            return redirect()->route('studentParent.index')->with('error', 'Wali murid tidak dapat dihapus karena masih ada siswa yang terdaftar!');
        }
        $studentParent->delete();

        return redirect()->route('studentParent.index')->with('success', 'Data wali murid berhasil dihapus!');
    }
}
