@extends('layouts.form')
@section('content')
<form method="POST" action="{{ route('classroom.update', $classroom) }}">
    @csrf
    @method('PUT')
    
    <div class="form-section">
        <label for="class_name" class="form-label"><i class="bi bi-journal-text me-1"></i> Nama Kelas</label>
        <input type="text" id="class_name" name="class_name" class="form-control @error('class_name') is-invalid @enderror" required 
                placeholder="Masukkan Nama Kelas" value="{{ old('class_name', $classroom->class_name) }}">
        @error('class_name')
            <div class="invalid-feedback">
                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
            </div>
        @enderror
    </div>
    
    <div class="d-flex justify-content-end mt-4 gap-3">
        <a href="{{ route('classroom.index') }}" class="btn btn-secondary">
            <i class="bi bi-x-circle me-1"></i> Batal
        </a>
        <button type="submit" class="btn btn-success">
            <i class="bi bi-save-fill me-1"></i> Simpan
        </button>
    </div>
</form>
@endsection
