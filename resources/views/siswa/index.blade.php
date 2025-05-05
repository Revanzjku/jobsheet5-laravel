@extends('layouts.app')
@section('content')
<div class="card-body">
    <div class="row g-3 mb-4">
        <div class="col-12 col-md-4">
            <div class="action-buttons">
                <a href="{{ route('classroom.index') }}" class="btn btn-primary">
                    <i class="bi bi-journal-text me-1"></i> Kelola Kelas
                </a>
                <a href="{{ route('studentParent.index') }}" class="btn btn-primary">
                    <i class="bi bi-person-video"></i> Kelola Wali
                </a>
            </div>
        </div>
        <div class="col-12 col-md-5">
            <form action="{{ route('student.index') }}" method="GET" class="d-flex search-section">
                <input type="search" name="search" class="form-control me-2" placeholder="Cari siswa..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-search me-1"></i> Cari
                </button>
            </form>
        </div>
        <div class="col-12 col-md-3 text-md-end">
            <a href="{{ route('student.create') }}" class="btn btn-success w-100 w-md-auto">
                <i class="bi bi-plus-circle me-1"></i> Tambah Siswa
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
                    <th><i class="bi bi-card-text me-1"></i> NIS</th>
                    <th><i class="bi bi-person-fill me-1"></i> Nama</th>
                    <th><i class="bi bi-gender-ambiguous me-1"></i> Jenis Kelamin</th>
                    <th class="d-none d-md-table-cell"><i class="bi bi-geo-alt-fill me-1"></i> Tempat Lahir</th>
                    <th class="d-none d-md-table-cell"><i class="bi bi-calendar-event me-1"></i> Tanggal Lahir</th>
                    <th><i class="bi bi-house-door-fill me-1"></i> Kelas</th>
                    <th class="d-none d-lg-table-cell"><i class="bi bi-person-badge-fill me-1"></i> Wali Murid</th>
                    <th><i class="bi bi-gear-fill me-1"></i> Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)    
                    <tr class="text-center">
                        <td class="fw-semibold">{{ $student->NIS }}</td>
                        <td>{{ $student->student_name }}</td>
                        <td>{{ $student->gender }}</td>
                        <td class="d-none d-md-table-cell">{{ $student->place_of_birth }}</td>
                        <td class="d-none d-md-table-cell">{{ $student->date_of_birth }}</td>
                        <td>
                            <span class="badge bg-primary">{{ $student->classroom->class_name }}</span>
                        </td>
                        <td class="d-none d-lg-table-cell">{{ $student->studentParent->parent_name }}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('student.edit', $student) }}" class="btn btn-warning btn-sm me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $student->id }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                                <div class="modal fade" id="deleteModal{{ $student->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $student->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $student->id }}">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Yakin ingin menghapus siswa ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('student.destroy', $student) }}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
        <nav>
            {{ $students->appends(['search' => request('search')])->links('pagination::bootstrap-5') }}
        </nav>
    </div>
</div>
@endsection