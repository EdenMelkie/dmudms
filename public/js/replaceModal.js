  document.getElementById('multi-replace-btn').addEventListener('click', function() {
        let selected = document.querySelectorAll('input[name="student_ids[]"]:checked');
        if (selected.length === 0) {
            alert('Please select at least one student.');
            return;
        }
        document.getElementById('multi-replace-modal').style.display = 'block';
    });

    document.getElementById('confirm-multi-replace').addEventListener('click', function() {
        let selectedStudents = [];
        document.querySelectorAll('input[name="student_ids[]"]:checked').forEach(cb => selectedStudents.push(cb.value));
        let newRoomId = document.getElementById('new-room-id').value;

        fetch("{{ route('students.multiReplace') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    student_ids: selectedStudents,
                    new_room_id: newRoomId
                })
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message || 'Replace successful!');
                location.reload();
            });
    });

    document.querySelectorAll('[data-bs-target^="#replaceModal"]').forEach(button => {
        button.addEventListener('click', function () {
            const studentId = this.getAttribute('data-bs-target').replace('#replaceModal', '');
            const roomSelect = document.querySelector(`#replaceModal${studentId} select[name="room_id"]`);
            const blockSelect = document.querySelector(`#replaceModal${studentId} select[name="block"]`);

            fetch(`/placements/available-rooms/${studentId}`)
                .then(res => res.json())
                .then(rooms => {
                    roomSelect.innerHTML = ''; // clear previous
                    const blockOptions = new Set();

                    rooms.forEach(room => {
                        roomSelect.innerHTML += `<option value="${room.room_id}">${room.room_id} (${room.block})</option>`;
                        blockOptions.add(room.block);
                    });

                    blockSelect.innerHTML = '';
                    blockOptions.forEach(block => {
                        blockSelect.innerHTML += `<option value="${block}">${block}</option>`;
                    });
                });
        });
    });