<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $rules = [
            'student_name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'place_of_birth' => 'required|string|max:100',
            'date_of_birth' => 'required|date',
            'classroom_id' => 'required|exists:classrooms,id',
            'student_parent_id' => 'required|exists:student_parents,id'
        ];
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $studentId = $this->route('student')->id;
            $rules['NIS'] = [
                'required',
                'size:7',
                Rule::unique('students', 'NIS')->ignore($studentId)
            ];
        } else {
            $rules['NIS'] = 'required|size:7|unique:students,NIS';
        }
        
        return $rules;
    }
    public function messages(): array
    {
        return [
            'NIS.required' => 'NIS wajib diisi',
            'NIS.size' => 'NIS harus terdiri dari 7 karakter',
            'NIS.unique' => 'NIS sudah digunakan oleh siswa lain',
            
            'student_name.required' => 'Nama siswa wajib diisi',
            'student_name.string' => 'Nama siswa harus berupa teks',
            'student_name.max' => 'Nama siswa maksimal 255 karakter',
            
            'gender.required' => 'Jenis kelamin wajib dipilih',
            'gender.in' => 'Jenis kelamin harus L atau P',
            
            'place_of_birth.required' => 'Tempat lahir wajib diisi',
            'place_of_birth.string' => 'Tempat lahir harus berupa teks',
            'place_of_birth.max' => 'Tempat lahir maksimal 100 karakter',
            
            'date_of_birth.required' => 'Tanggal lahir wajib diisi',
            'date_of_birth.date' => 'Format tanggal lahir tidak valid',
            
            'classroom_id.required' => 'Kelas wajib dipilih',
            'classroom_id.exists' => 'Kelas yang dipilih tidak valid',
            
            'student_parent_id.required' => 'Orang tua wajib dipilih',
            'student_parent_id.exists' => 'Orang tua yang dipilih tidak valid'
        ];
    }
}
