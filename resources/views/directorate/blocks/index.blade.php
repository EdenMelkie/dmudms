@extends('layouts.appdirectorate')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center">Manage Blocks</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('directorate.blocks.create') }}" class="btn btn-primary mb-4">
            <i class="fas fa-plus-circle"></i> Register New Block
        </a>

        <table class="table table-bordered mt-4">
            <thead class="table-dark">
                <tr>
                    <th>Block ID</th>
                    <th>Disable Group</th>
                    <th>Status</th>
                    <th>Capacity</th>
                    <th>Reserved For</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blocks as $block)
                    <tr>
                        <td>{{ $block->block_id }}</td>
                        <td>{{ $block->disable_group }}</td>
                        <td>{{ $block->status }}</td>
                        <td>{{ $block->capacity }}</td>
                        <td>{{ $block->reserved_for }}</td>
                        <td>
                            <a href="{{ route('directorate.blocks.edit', $block->block_id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('directorate.blocks.destroy', $block->block_id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
