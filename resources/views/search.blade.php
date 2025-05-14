@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Search Placement Records</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('placements.search') }}">
                        @csrf

                        <div class="form-group row mb-4">
                            <div class="col-md-3">
                                <select class="form-control form-select" name="search_by" id="search_by" required>
                                    <option value="">Select Field</option>
                                    <option value="student_id">Student ID</option>
                                    <option value="block">Block</option>
                                    <option value="room">Room</option>
                                    <option value="status">Status</option>
                                    <option value="year">Year</option>
                                </select>
                            </div>

                            <div class="col-md-7">
                                <input type="text" class="form-control" name="search_value" 
                                       id="search_value" placeholder="Enter search value" required>
                            </div>

                            <div class="col-md-2">
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="fas fa-search"></i> Search
                                </button>
                            </div>
                        </div>
                    </form>

                    @if(isset($placements))
                        <hr>

                        @if($placements->isEmpty())
                            <div class="alert alert-info mt-3">
                                No records found matching your criteria.
                            </div>
                        @else
                            <div class="table-responsive mt-3">
                                <table class="table table-striped table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Placement ID</th>
                                            <th>Student ID</th>
                                            <th>Block</th>
                                            <th>Room</th>
                                            <th>Status</th>
                                            <th>Year</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($placements as $placement)
                                        <tr>
                                            <td>{{ $placement->placement_id }}</td>
                                            <td>{{ $placement->student_id }}</td>
                                            <td>{{ $placement->block }}</td>
                                            <td>{{ $placement->room }}</td>
                                            <td>{{ $placement->status }}</td>
                                            <td>{{ $placement->year }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchBy = document.getElementById('search_by');
        const searchValue = document.getElementById('search_value');
        
        searchBy.addEventListener('change', function() {
            // Clear the search value when changing search field
            searchValue.value = '';
            
            // Update placeholder based on selection
            const selectedOption = this.options[this.selectedIndex].text;
            searchValue.placeholder = `Enter ${selectedOption}`;
        });
    });
</script>
@endsection
