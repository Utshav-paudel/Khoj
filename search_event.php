<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

require_once 'db_connection.php';

$events = [];
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

if (!empty($search)) {
    $stmt = $conn->prepare("SELECT * FROM events WHERE name LIKE ? OR description LIKE ?");
    $search_term = '%' . $search . '%';
    $stmt->bind_param("ss", $search_term, $search_term);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Events</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .btn-dashboard {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            text-align: center;
            margin-bottom: 20px;
            display: inline-block;
            transition: background-color 0.3s;
        }

        .btn-dashboard:hover {
            background-color: #0056b3;
        }

        .btn-dashboard:focus {
            outline: none;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <a href="dashboard.php" class="btn-dashboard">Go to Dashboard</a>
        <h2>Search Events</h2>
        <form action="search_event.php" method="get">
            <div class="form-group">
                <input type="text" class="form-control" name="search" placeholder="Search for events" value="<?php echo htmlspecialchars($search); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        <div class="mt-4">
            <?php if (!empty($search) && $events): ?>
                <ul class="list-group">
                    <?php foreach ($events as $event): ?>
                        <li class="list-group-item">
                            <h5><?php echo htmlspecialchars($event['name']); ?></h5>
                            <p><?php echo htmlspecialchars($event['description']); ?></p>
                            <a href="event_details.php?id=<?php echo $event['id']; ?>" class="btn btn-secondary">View Details</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php elseif (!empty($search)): ?>
                <p>No events found.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
