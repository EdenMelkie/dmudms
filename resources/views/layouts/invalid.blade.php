<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied</title>
    <link rel="shortcut icon" href="images/debremarkos_logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles for the modal */
        .custom-modal {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1050;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            display: block;
            /* Show the modal on page load */
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            display: block;
            /* Show the overlay on page load */
        }
    </style>
</head>

<body>
    <!-- Modal Overlay -->
    <div id="modalOverlay" class="modal-overlay"></div>

    <!-- Custom Modal -->
    <div id="customModal" class="custom-modal">
        <h1>Access Denied</h1>
        <p>You do not have the required permissions to view this page. (Admin)</p>
        <a href="{{ route('login') }}" class="btn btn-secondary">Return to Login</a>
        <button id="closeModalBtn" class="btn btn-danger mt-2">Close</button>
    </div>

    <script>
        // Get elements
        const closeModalBtn = document.getElementById('closeModalBtn');
        const customModal = document.getElementById('customModal');
        const modalOverlay = document.getElementById('modalOverlay');

        // Hide modal when clicking the "Close" button
        closeModalBtn.addEventListener('click', () => {
            customModal.style.display = 'none';
            modalOverlay.style.display = 'none';
        });

        // Hide modal when clicking on the overlay
        modalOverlay.addEventListener('click', () => {
            customModal.style.display = 'none';
            modalOverlay.style.display = 'none';
        });
    </script>
</body>

</html>