document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('block-select').addEventListener('change', function () {
        const block = this.value;
        const roomSelect = document.getElementById('room-select');

        fetch(`/get-rooms/${block}`)
            .then(response => response.json())
            .then(data => {
                roomSelect.innerHTML = '<option value="">-- Select Room --</option>';
                data.forEach(room => {
                    const displayText = `Room ${room.room_id} - Capacity: ${room.capacity} - ${room.status}`;
                    const option = document.createElement('option');
                    option.value = room.room_id;
                    option.textContent = displayText;
                    roomSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching rooms:', error);
            });
    });
});
