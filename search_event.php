<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

require_once 'db_connection.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';
$events = [];

// Fetch all events by default
$stmt = $conn->prepare("SELECT * FROM events");
$stmt->execute();
$result = $stmt->get_result();
$events = $result->fetch_all(MYSQLI_ASSOC);

// If search is performed, filter the results
if ($search) {
    $filtered_events = [];
    foreach ($events as $event) {
        if (stripos($event['name'], $search) !== false || stripos($event['description'], $search) !== false) {
            $filtered_events[] = $event;
        }
    }
    $events = $filtered_events;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event List</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Event List</h2>
        <form action="search_event.php" method="get">
            <div class="mb-3">
                <input type="text" class="form-control" id="search" name="search" placeholder="Search for events..." value="<?php echo htmlspecialchars($search); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        
        <h3 class="mt-4">Events</h3>
        <?php if (!empty($events)): ?>
            <div class="list-group">
                <?php foreach ($events as $event): ?>
                    <a href="event_details.php?id=<?php echo $event['id']; ?>" class="list-group-item list-group-item-action">
                        <?php echo htmlspecialchars($event['name']); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="mt-4">No events found.</p>
        <?php endif; ?>
        
        <a href="dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
    </div>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>