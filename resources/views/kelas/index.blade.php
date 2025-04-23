@extends('layouts.app')
@section('content')
<div class="card-body">
    <div class="row g-3 mb-4">
        <div class="col-12 col-md-4">
            <div class="action-buttons">
                <a href="{{ route('student.index') }}" class="btn btn-primary">
                    <i class="bi bi-people-fill me-2"></i> Kelola Siswa
                </a>
                <a href="{{ route('studentParent.index') }}" class="btn btn-primary">
                    <i class="bi bi-person-video"></i> Kelola Wali
                </a>
            </div>
        </div>
        <div class="col-12 col-md-5">
            <form action="{{ route('classroom.index') }}" method="GET" class="d-flex search-section">
                <input type="search" name="search" class="form-control me-2" placeholder="Cari kelas..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-search me-1"></i> Cari
                </button>
            </form>
        </div>
        <div class="col-12 col-md-3 text-md-end">
            <a href="{{ route('classroom.create') }}" class="btn btn-success w-100 w-md-auto">
                <i class="bi bi-plus-circle me-1"></i> Tambah Kelas
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr class="text-center">
                    <th width="10%"><i class="bi bi-hash me-1"></i></th>
                    <th><i class="bi bi-journal-text me-1"></i> Nama Kelas</th>
                    <th width="20%"><i class="bi bi-gear-fill me-1"></i> Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classrooms as $classroom)    
                <tr class="text-center">
                    <td class="fw-semibold">{{ $loop->iteration + ($classrooms->currentPage() - 1) * $classrooms->perPage() }}</td>
                    <td>
                        <span class="badge bg-primary rounded-pill px-3 py-2">
                            {{ $classroom->class_name }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('classroom.edit', $classroom) }}" class="btn btn-warning btn-sm me-1" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('classroom.destroy', $classroom) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus kelas ini?')" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>                    
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
        <nav>
            {{ $classrooms->appends(['search' => request('search')])->links('pagination::bootstrap-5') }}
        </nav>
    </div>
</div>
@endsection
