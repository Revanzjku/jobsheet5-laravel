@extends('layouts.app')
@section('content')
<h2 class="mb-4 text-center">{{ $title }}</h2>
<div class="row g-3 mb-3">
    <div class="col-12 col-md-4">
        <div class="action-buttons">
            <a href="{{ route('kelas.index') }}" class="btn btn-primary mb-2 mb-md-0">Kelola Kelas</a>
            <a href="{{ route('wali.index') }}" class="btn btn-primary">Kelola Wali Murid</a>
        </div>
    </div>
    <div class="col-12 col-md-5">
        <form action="{{ route('student.index') }}" method="GET" class="d-flex search-section">
            <input type="search" name="search" class="form-control me-2" placeholder="Cari siswa..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-success">Cari</button>
        </form>
    </div>
    <div class="col-12 col-md-3 text-md-end">
        <a href="{{ route('student.create') }}" class="btn btn-success w-100 w-md-auto">Tambah Siswa</a>
    </div>
</div>
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="table-dark text-center">
            <th>NIS</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th class="d-none d-md-table-cell">Tempat Lahir</th>
            <th class="d-none d-md-table-cell">Tanggal Lahir</th>
            <th>Kelas</th>
            <th class="d-none d-lg-table-cell">Wali Murid</th>
            <th>Aksi</th>
        </thead>
        <tbody>
            @foreach ($students as $student)    
                <tr class="text-center">
                    <td>{{ $student->NIS }}</td>
                    <td>{{ $student->student_name }}</td>
                    <td>{{ $student->gender }}</td>
                    <td class="d-none d-md-table-cell">{{ $student->place_of_birth }}</td>
                    <td class="d-none d-md-table-cell">{{ $student->date_of_birth }}</td>
                    <td>{{ $student->classroom->class_name }}</td>
                    <td class="d-none d-lg-table-cell">{{ $student->studentParent->parent_name }}</td>
                    <td>
                        <div class="table-actions">
                            <a href="{{ route('student.edit', $student) }}" class="btn btn-warning btn-sm mb-1 mb-md-0">Edit</a>
                            <form action="{{ route('student.destroy', $student) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm mb-1 mb-md-0" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>                    
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <nav class="mt-3">
        {{ $students->appends(['search' => request('search')])->links('pagination::bootstrap-5') }}
    </nav>
</div>
@endsection