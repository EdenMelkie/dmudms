@extends('layouts.appproc')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4 text-success">Registered Materials</h2>

    @if($materials->isEmpty())
    <div class="alert alert-info text-center">No materials registered yet.</div>
    @else
    <div class="card shadow-lg">
        <div class="card-body table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="table-dark">
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
                    <tr>
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
                        <td>{{ $material->created_at ? $material->created_at->format('Y-m-d H:i') : 'N/A' }}</td>
                        <td class="d-flex justify-content-center">
                            <!-- Edit Button (Triggers Modal) -->
                            <button type="button" class="btn btn-sm btn-warning mx-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $material->registration_id }}">
                                <i class="bi bi-pencil"></i> Edit
                            </button>

                            <!-- Delete Button (Triggers Modal) -->
                            <button type="button" class="btn btn-sm btn-danger mx-1" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $material->registration_id }}">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $material->registration_id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $material->registration_id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{ $material->registration_id }}">Edit Material</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('materials.edit', $material->registration_id) }}" method="GET">
                                        <div class="mb-3">
                                            <label for="block" class="form-label">Block</label>
                                            <input type="text" class="form-control" id="block" name="block" value="{{ $material->block }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="room" class="form-label">Room</label>
                                            <input type="text" class="form-control" id="room" name="room" value="{{ $material->room }}">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal{{ $material->registration_id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $material->registration_id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $material->registration_id }}">Delete Material</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="text-warning">Are you sure you want to delete this material? This action cannot be undone.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('materials.destroy', $material->registration_id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mb-3 text-right">
            <a href="{{ route('materials.create') }}" class="btn btn-lg btn-success">
                <i class="bi bi-plus-circle"></i> Register New Materials
            </a>
        </div>
    </div>
    @endif
</div>

@endsection
