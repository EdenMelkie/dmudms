<form id="multi-replace-form" class="bg-white shadow-md rounded-lg p-6">
    @csrf

    <h2 class="text-xl font-semibold mb-4">Assigned Students</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full table-auto text-left border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">Select</th>
                    <th class="px-4 py-2 border">Name</th>
                    <th class="px-4 py-2 border">Room</th>
                    <th class="px-4 py-2 border">Block</th>
                </tr>
            </thead>
            <tbody>
                @forelse($assignedStudents as $student)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">
                            <input type="checkbox" name="student_ids[]" value="{{ $student->id }}" class="form-checkbox">
                        </td>
                        <td class="px-4 py-2 border">{{ $student->name }}</td>
                        <td class="px-4 py-2 border">{{ $student->room->room_number ?? 'N/A' }}</td>
                        <td class="px-4 py-2 border">{{ $student->room->block->block_name ?? 'N/A' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-4 text-center text-gray-500">No assigned students found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <button type="button" id="multi-replace-btn"
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-200">
            Replace Selected
        </button>
    </div>
</form>
