@extends('layouts.form')
@section('content')
<form method="POST" action="{{ $student ? route('student.update', $student) : route('student.store') }}">
    @if ($student)
        @method('PUT')
    @endif
    @csrf
    
    <div class="row g-3">
        <div class="col-md-6 form-section">
            <label for="NIS" class="form-label"><i class="bi bi-card-text me-1"></i> NIS</label>
            <input type="text" id="NIS" name="NIS" class="form-control @error('NIS') is-invalid @enderror" required 
                placeholder="Masukkan NIS" value="{{ old('NIS', $student->NIS ?? '') }}">
            @error('NIS')
                <div class="invalid-feedback">
                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                </div>
            @enderror
        </div>
        
        <div class="col-md-6 form-section">
            <label for="student_name" class="form-label"><i class="bi bi-person-fill me-1"></i> Nama Siswa</label>
            <input type="text" id="student_name" name="student_name" class="form-control @error('student_name') is-invalid @enderror" required 
                placeholder="Masukkan Nama Siswa" value="{{ old('student_name', $student->student_name ?? '') }}">
            @error('student_name')
                <div class="invalid-feedback">
                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                </div>
            @enderror
        </div>
        
        <div class="col-md-6 form-section">
            <label for="gender" class="form-label"><i class="bi bi-gender-ambiguous me-1"></i> Jenis Kelamin</label>
            <select id="gender" name="gender" class="form-select @error('gender') is-invalid @enderror" required>
                <option value="">Pilih Jenis Kelamin</option>
                <option value="L" {{ old('gender', $student->gender ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ old('gender', $student->gender ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('gender')
                <div class="invalid-feedback">
                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                </div>
            @enderror
        </div>
        
        <div class="col-md-6 form-section">
            <label for="place_of_birth" class="form-label"><i class="bi bi-geo-alt-fill me-1"></i> Tempat Lahir</label>
            <input type="text" id="place_of_birth" name="place_of_birth" class="form-control @error('place_of_birth') is-invalid @enderror" required 
                placeholder="Masukkan Tempat Lahir" value="{{ old('place_of_birth', $student->place_of_birth ?? '') }}">
            @error('place_of_birth')
                <div class="invalid-feedback">
                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                </div>
            @enderror
        </div>
        
        <div class="col-md-6 form-section">
            <label for="date_of_birth" class="form-label"><i class="bi bi-calendar-event me-1"></i> Tanggal Lahir</label>
            <input type="date" id="date_of_birth" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" required 
                value="{{ old('date_of_birth', $student->date_of_birth ?? '') }}">
            @error('date_of_birth')
                <div class="invalid-feedback">
                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                </div>
            @enderror
        </div>
        
        <div class="col-md-6 form-section">
            <label for="classroom_id" class="form-label"><i class="bi bi-house-door-fill me-1"></i> Kelas</label>
            <select id="classroom_id" name="classroom_id" class="form-select @error('classroom_id') is-invalid @enderror" required>
                <option value="">Pilih Kelas</option>
                @foreach ($classrooms as $class)
                    <option value="{{ $class->id }}" {{ old('classroom_id', $student->classroom_id ?? '') == $class->id ? 'selected' : '' }}>
                        {{ $class->class_name }}
                    </option>
                @endforeach
            </select>
            @error('classroom_id')
                <div class="invalid-feedback">
                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                </div>
            @enderror
        </div>
        
        <div class="col-md-6 form-section">
            <label for="student_parent_id" class="form-label"><i class="bi bi-person-badge-fill me-1"></i> Wali Murid</label>
            <select id="student_parent_id" name="student_parent_id" class="form-select @error('student_parent_id') is-invalid @enderror" required>
                <option value="">Pilih Wali Murid</option>
                @foreach ($parents as $parent)
                    <option value="{{ $parent->id }}" {{ old('student_parent_id', $student->student_parent_id ?? '') == $parent->id ? 'selected' : '' }}>
                        {{ $parent->parent_name }}
                    </option>
                @endforeach
            </select>
            @error('student_parent_id')
                <div class="invalid-feedback">
                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                </div>
            @enderror
        </div>
    </div>
    
    <div class="d-flex justify-content-end mt-4 gap-3">
        <a href="{{ route('student.index') }}" class="btn btn-secondary">
            <i class="bi bi-x-circle me-1"></i> Batal
        </a>
        <button type="submit" class="btn btn-success">
            <i class="bi bi-save-fill me-1"></i> Simpan 
        </button>
    </div>
</form>
@endsection