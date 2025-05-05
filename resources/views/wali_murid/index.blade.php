@extends('layouts.app')
@section('content')
<div class="card-body">
    <div class="row g-3 mb-4">
        <div class="col-12 col-md-4">
            <div class="action-buttons">
                <a href="{{ route('student.index') }}" class="btn btn-primary">
                    <i class="bi bi-people-fill me-2"></i> Kelola Siswa
                </a>
                <a href="{{ route('classroom.index') }}" class="btn btn-primary">
                    <i class="bi bi-journal-text me-1"></i> Kelola Kelas
                </a>
            </div>
        </div>
        <div class="col-12 col-md-5">
            <form action="{{ route('studentParent.index') }}" method="GET" class="d-flex search-section">
                <input type="search" name="search" class="form-control me-2" placeholder="Cari wali..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-search me-1"></i> Cari
                </button>
            </form>
        </div>
        <div class="col-12 col-md-3 text-md-end">
            <a href="{{ route('studentParent.create') }}" class="btn btn-success w-100 w-md-auto">
                <i class="bi bi-plus-circle me-1"></i> Tambah Wali Murid
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr class="text-center">
                    <th width="10%"><i class="bi bi-hash me-1"></i></th>
                    <th><i class="bi bi-person-vcard me-1"></i> Nama Wali</th>
                    <th><i class="bi bi-telephone-fill me-1"></i> Kontak</th>
                    <th><i class="bi bi-gear-fill me-1"></i> Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($studentParents as $studentParent)    
                <tr class="text-center">
                    <td class="fw-semibold">{{ $studentParents->firstItem() + $loop->index }}</td>
                    <td>{{ $studentParent->parent_name }}</td>
                    <td>{{ $studentParent->contact }}</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('studentParent.edit', $studentParent) }}" class="btn btn-warning btn-sm me-1" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $studentParent->id }}">
                                <i class="bi bi-trash"></i>
                            </button>
                            <div class="modal fade" id="deleteModal{{ $studentParent->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $studentParent->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $studentParent->id }}">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Yakin ingin menghapus wali murid ini?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <form action="{{ route('studentParent.destroy', $studentParent) }}" method="post" class="d-inline">
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
            {{ $studentParents->appends(['search' => request('search')])->links('pagination::bootstrap-5') }}
        </nav>
    </div>
</div>
@endsection
