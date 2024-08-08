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
</head>
<body>
    <div class="container mt-5">
        <h2>Welcome to the Dashboard</h2>
        <div class="mt-4">
            <a href="register_event.php" class="btn btn-primary">Register Event</a>
            <a href="search_event.php" class="btn btn-secondary">Search Event</a>
        </div>
        <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
    </div>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>