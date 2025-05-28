@extends('layouts.appproc')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4 text-success fw-bold">📋 Registered Materials</h2>

    <!-- Search Form -->
    <fieldset class="border rounded p-4 shadow-sm mb-4 bg-light">
        <legend class="w-auto px-3 fw-semibold text-primary">🔍 Search</legend>
        <form method="GET" action="{{ route('materials.view') }}" class="row g-3 justify-content-center">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control" placeholder="Search by Block, Room, Unlocker, or Date (YYYY-MM-DD)" value="{{ request('search') }}">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
            @if(request('search'))
            <div class="col-auto">
                <a href="{{ route('materials.view') }}" class="btn btn-secondary">
                    <i class="fas fa-times-circle"></i> Clear
                </a>
            </div>
            @endif
        </form>
    </fieldset>

    <!-- No Data Alert -->
    @if($materials->isEmpty())
    <div class="alert alert-info text-center shadow-sm">
        <i class="fas fa-info-circle"></i> No materials registered yet.
    </div>
    @else

    <!-- Materials Table -->
    <div class="card shadow">
        <div class="card-body table-responsive p-0">
            <table class="table table-bordered table-striped table-hover mb-0">
                <thead class="table-dark text-center">
                    <tr>
                        <th>#</th>
                        <th>Block</th>
                        <th>Room</th>
                        <th>Unlocker</th>
                        <th>Locker</th>
                        <th>Chair</th>
                        <th>Pure Foam</th>
                        <th>Damaged Foam</th>
                        <th>Tiras</th>
                        <th>Tables</th>
                        <th>Chibud</th>
                        <th>Registered At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($materials as $index => $material)
                    <tr class="text-center align-middle">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $material->block }}</td>
                        <td>{{ $material->room }}</td>
                        <td>{{ $material->unlocker }}</td>
                        <td>{{ $material->locker }}</td>
                        <td>{{ $material->chair }}</td>
                        <td>{{ $material->pure_foam }}</td>
                        <td>{{ $material->damaged_foam }}</td>
                        <td>{{ $material->tiras }}</td>
                        <td>{{ $material->tables }}</td>
                        <td>{{ $material->chibud }}</td>
                        <td>{{ $material->created_at ? $material->created_at->format('d-m-Y') : 'N/A' }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2 flex-wrap">
                                <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $material->registration_id }}">
                                    <i class="fas fa-pen-to-square"></i>
                                </button>

                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $material->registration_id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    {{-- Edit Modal --}}
                    <div class="modal fade" id="editModal{{ $material->registration_id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $material->registration_id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-warning text-dark">
                                    <h5 class="modal-title"><i class="fas fa-edit me-1"></i> Edit Material</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('materials.update', $material->registration_id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <input type="hidden" name="block" value="{{ $material->block }}">
                                        <input type="hidden" name="room" value="{{ $material->room }}">

                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Unlocker</label>
                                                <input type="text" class="form-control" name="unlocker" value="{{ $material->unlocker }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Locker</label>
                                                <input type="text" class="form-control" name="locker" value="{{ $material->locker }}">
                                            </div>

                                            @foreach(['chair', 'pure_foam', 'damaged_foam', 'tiras', 'tables', 'chibud'] as $field)
                                            <div class="col-md-4">
                                                <label class="form-label">{{ ucwords(str_replace('_', ' ', $field)) }}</label>
                                                <input type="number" class="form-control" name="{{ $field }}" value="{{ $material->$field }}">
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            <i class="fas fa-times"></i> Close
                                        </button>
                                        <button type="submit" class="btn btn-warning">
                                            <i class="fas fa-save"></i> Save Changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Delete Modal --}}
                    <div class="modal fade" id="deleteModal{{ $material->registration_id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $material->registration_id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title"><i class="fas fa-trash-alt me-1"></i> Confirm Delete</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="fw-semibold text-danger">Are you sure you want to delete this material? This action cannot be undone.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('materials.destroy', $material->registration_id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4 text-end px-3">
            <a href="{{ route('materials.create') }}" class="btn btn-success btn-lg shadow">
                <i class="fas fa-plus"></i> Register New Materials
            </a>
        </div>
    </div>
    @endif
</div>
@endsection