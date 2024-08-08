<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

require_once 'db_connection.php';

$event_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($event_id) {
    $stmt = $conn->prepare("SELECT * FROM events WHERE id = ?");
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $event = $result->fetch_assoc();
} else {
    header("Location: search_event.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Details</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <!-- <h2>Event Details</h2> -->
        <?php if ($event): ?>
            <h3><?php echo htmlspecialchars($event['name']); ?></h3>
            <?php if ($event['image_path']): ?>
                <img src="<?php echo htmlspecialchars($event['image_path']); ?>" alt="Event Image" class="img-fluid mt-3" >
            <?php endif; ?>
            <p><strong>Description:</strong> <?php echo htmlspecialchars($event['description']); ?></p>
            <p><strong>Start Date:</strong> <?php echo $event['start_date']; ?></p>
            <p><strong>End Date:</strong> <?php echo $event['end_date']; ?></p>
            <?php if ($event['google_map_url']): ?>
                <p><strong>Location:</strong> <a href="<?php echo htmlspecialchars($event['google_map_url']); ?>" target="_blank">View on Google Maps</a></p>
            <?php endif; ?>
           
        <?php else: ?>
            <p>Event not found.</p>
        <?php endif; ?>
        <a href="search_event.php" class="btn btn-secondary mt-3">Back to Search</a>
    </div>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>