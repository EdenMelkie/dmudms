@extends('layouts.appstd')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Search Placement Records</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('rooms') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-3">
                                <select class="form-control" name="search_by" id="search_by" required>
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
                                    type="hidden" id="search_value" placeholder="Enter search value" required style="display: block;">
                            </div>

                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Search
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
                    <h5>Search Results For:
                        {{ $placements->first()->student_id }}
                    </h5>

                    <div class="table-responsive mt-2">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Placement ID</th>
                                    <th>Student ID</th>
                                    <th>Student Name</th>
                                    <th>Block</th>
                                    <th>Room</th>
                                    <th>Status</th>
                                    <th>Year</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($placements as $placement)
                                <tr>
                                    <td>{{ $placement->placement_id }}</td>
                                    <td>{{ $placement->student_id }}</td>
                                    <td>{{ $placement->first_name }} {{ $placement->second_name }} {{ $placement->last_name }}</td>
                                    <td>{{ $placement->block }}</td>
                                    <td>{{ $placement->room }}</td>
                                    <td>{{ $placement->status }}</td>
                                    <td>{{ $placement->year }}</td>
                                    <td>
                                        @if($placement->status !== 'Getin')
                                        <form action="{{ route('activate', $placement->placement_id) }}" method="POST" onsubmit="return confirmActivate(event)">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Activate</button>
                                        </form>
                                        @else
                                        <span class="badge badge-success">Activated</span>
                                        @endif
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                    @endif

                    @isset($roommates)
                    @if(!$roommates->isEmpty())
                    <hr>
                    <h5>Other Students Assigned to Room: {{ $placements->first()->block }} / {{ $placements->first()->room }}</h5>
                    <div class="table-responsive mt-2">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Student ID</th>
                                    <th>Student Name</th>
                                    <th>Block</th>
                                    <th>Room</th>
                                    <th>Status</th>
                                    <th>Year</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roommates as $roommate)
                                <tr>
                                    <td>{{ $roommate->student_id }}</td>
                                    <td>{{ $roommate->first_name }} {{ $roommate->second_name }} {{ $roommate->last_name }}</td>
                                    <td>{{ $roommate->block }}</td>
                                    <td>{{ $roommate->room }}</td>
                                    <td>{{ $roommate->status }}</td>
                                    <td>{{ $roommate->year }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="alert alert-warning mt-3">
                        No other students are assigned to this room.
                    </div>
                    @endif
                    @endisset

                    @isset($proctors)
                    @if(!$proctors->isEmpty())
                    <hr>
                    <h5>Assigned Proctors for Block: {{ $placements->first()->block }}</h5>
                    <div class="table-responsive mt-2">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Proctor Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($proctors as $proctor)
                                <tr>
                                    <td>{{ $proctor->first_name }} {{ $proctor->second_name }} {{ $proctor->last_name }}</td>
                                    <td>{{ $proctor->email }}</td>
                                    <td>{{ $proctor->phone }}</td>
                                    <td>{{ $proctor->gender }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="alert alert-warning mt-3">
                        No proctors are assigned to this block.
                    </div>
                    @endif
                    @endisset
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
            const selected = this.value;
            searchValue.value = '';
            searchValue.placeholder = `Enter ${this.options[this.selectedIndex].text}`;

            if (selected === 'student_id') {
                // Hide the input and set value from session via hidden input
                searchValue.style.display = 'none';

                // You can optionally set the value here if session is rendered in the blade template:
                searchValue.value = "{{ session('username') }}";
            } else {
                searchValue.style.display = 'block';
            }
        });

        // Trigger change event on page load (in case student_id is pre-selected)
        searchBy.dispatchEvent(new Event('change'));
    });
</script>

<script>
    function confirmActivate(event) {
        if (confirm('Are you sure you want to activate this student?')) {
            return true;
        }
        event.preventDefault();
        return false;
    }

</script>


@endsection