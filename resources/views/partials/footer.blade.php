<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Footer</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

    <style>
        footer {
            background-color: #212529;
            color: #f8f9fa;
            padding: 15px 0;
            text-align: center;
            position: fixed;
            bottom: 0px;
            width: 100%;
            box-shadow: 0 -1px 5px rgba(0, 0, 0, 0.2);
            z-index: 1030;
            margin-top: auto;
        }


        footer p {
            margin: 0;
            font-size: 0.95rem;
            color: #ccc;
        }

        footer .footer-brand {
            font-weight: 600;
            font-size: 1rem;
            color: #f8f9fa;
        }

        footer i {
            color: #0d6efd;
            margin-right: 5px;
        }

        @media (max-width: 576px) {
            footer {
                font-size: 0.85rem;
                padding: 10px 5px;
            }
        }
    </style>
</head>

<body>

    <!-- Your main content goes here -->

    <footer>
        <p class="footer-brand">
            <i class="fas fa-university"></i> Debre Markos University Dormitory Management System
        </p>
        <p>&copy; <i>All Rights Reserved - 2017 E.C</i></p>
    </footer>

</body>

</html>