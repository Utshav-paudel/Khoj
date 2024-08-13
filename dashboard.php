<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            background-color: #574476;
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        .logout-btn {
            position: absolute;
            top: 10px;
            right: 20px;
        }

        .content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
        }

        .btn-container {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .btn-custom {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 250px;
            height: 60px;
            font-size: 18px;
            transition: transform 0.3s, box-shadow 0.3s;
            text-align: center;
            border-radius: 8px;
            text-decoration: none;
            color: #fff;
        }

        .btn-custom:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .btn-primary-custom {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary-custom:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .btn-secondary-custom {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary-custom:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        .btn-info-custom {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }

        .btn-info-custom:hover {
            background-color: #138496;
            border-color: #117a8b;
        }
        h2{
            color: white;
        }
        #login-top-header img{
            position: absolute;
            top: 15%;
            text-transform: capitalize;
            font-weight: 699;
            height: 200px;
            width: auto;
            filter: brightness(50%) invert(1);

        }
        #login-top-header
        {
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <a href="logout.php" class="btn btn-danger logout-btn">Logout</a>
    </div>
    <h1 id="login-top-header"><img src="images/logo.png" alt="logo"></h1>

    <div class="content">
        <div>
            <h2>Welcome to the Dashboard</h2>
            <div class="btn-container mt-4">
                <a href="register_event.php" class="btn btn-primary btn-custom btn-primary-custom">
                    Register Event
                </a>
                <a href="search_event.php" class="btn btn-secondary btn-custom btn-secondary-custom">
                    Search Event
                </a>
                <a href="eventlists.php" class="btn btn-info btn-custom btn-info-custom">
                    Show All Events
                </a>
            </div>
        </div>
    </div>

    <script src="js/bootstrap.min.js"></script>
</body>
</html>
