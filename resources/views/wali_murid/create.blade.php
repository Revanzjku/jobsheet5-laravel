@extends('layouts.form')
@section('content')
<form method="POST" action="{{ route('studentParent.store') }}">
    @csrf
    
    <div class="form-section">
        <label for="parent_name" class="form-label"><i class="bi bi-person-fill me-1"></i> Nama Wali Murid</label>
        <input type="text" id="parent_name" name="parent_name" class="form-control @error('parent_name') is-invalid @enderror" required 
                placeholder="Masukkan Nama Wali Murid" value="{{ old('parent_name') }}">
        @error('parent_name')
            <div class="invalid-feedback">
                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
            </div>
        @enderror
    </div>
    
    <div class="form-section">
        <label for="contact" class="form-label"><i class="bi bi-telephone-fill me-1"></i> Nomor Telepon</label>
        <input type="text" maxlength="20" id="contact" name="contact" class="form-control @error('contact') is-invalid @enderror" required 
                placeholder="Masukkan Nomor Telepon" value="{{ old('contact') }}">
        @error('contact')
            <div class="invalid-feedback">
                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
            </div>
        @enderror
    </div>
    
    <div class="d-flex justify-content-end mt-4 gap-3">
        <a href="{{ route('studentParent.index') }}" class="btn btn-secondary">
            <i class="bi bi-x-circle me-1"></i> Batal
        </a>
        <button type="submit" class="btn btn-success">
            <i class="bi bi-save-fill me-1"></i> Simpan
        </button>
    </div>
</form>
@endsection
