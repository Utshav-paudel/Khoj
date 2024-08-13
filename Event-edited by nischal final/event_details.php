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
    <style>
       body {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

.header {
    background-color: darkcyan;
    color: #fff;
    padding: 15px 20px;
    text-align: center;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.header h1 {
    margin: 0;
    font-size: 28px;
    font-weight: bold;
}

.container {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

.event-card {
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    max-width: 800px;
    width: 100%;
    transition: transform 0.3s, box-shadow 0.3s;
}

.event-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.event-card img {
    width: 100%;
    height: auto;
    object-fit: cover;
    transition: opacity 0.3s;
}

.event-card img:hover {
    opacity: 0.85;
}

.event-card-content {
    padding: 20px;
    background: #f8f9fa;
    border-top: 2px solid #007bff;
}

.event-card-content h3 {
    margin-top: 0;
    color: #333;
    font-size: 32px;
    font-weight: bold;
    text-align: center;
    text-transform: uppercase;
}

.event-card-content p {
    margin: 15px 0;
    color: #555;
    line-height: 1.6;
    text-transform: capitalize;
}

.event-card-content a {
    color: #007bff;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s;
}

.event-card-content a:hover {
    color: #0056b3;
}

.btn-back {
    display: inline-block;
    padding: 12px 24px;
    color: #fff; 
    border: 1px solid black;
    border-radius: 8px;
    text-align: center;
    text-decoration: none;
    font-size: 16px;
    font-weight: bold;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    cursor: pointer;
    margin: 20px 0; 
}

.btn-back:hover {
    background: #0056b3;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
}

.btn-back:active {
    background: #004494;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

    </style>
</head>

<body>
    <div class="header">
        <h1>Event Details</h1>
    </div>
    <div class="container">
        <div class="event-card">
            <?php if ($event): ?>
                <?php if ($event['image_path']): ?>
                    <img src="<?php echo htmlspecialchars($event['image_path']); ?>" alt="Event Image">
                <?php endif; ?>
                <div class="event-card-content">
                    <h3><?php echo htmlspecialchars($event['name']); ?></h3>
                    <p><strong>Description:</strong> <?php echo htmlspecialchars($event['description']); ?></p>
                    <p><strong>Start Date:</strong> <?php echo $event['start_date']; ?></p>
                    <p><strong>End Date:</strong> <?php echo $event['end_date']; ?></p>
                    <?php if ($event['google_map_url']): ?>
                        <p><strong>Location:</strong> <a href="<?php echo htmlspecialchars($event['google_map_url']); ?>"
                                target="_blank">View on Google Maps</a></p>
                    <?php endif; ?>
                    <a href="search_event.php" class="btn-back">Back to Search</a>
                </div>
            <?php else: ?>
                <p class="event-card-content">Event not found.</p>
            <?php endif; ?>
        </div>
    </div>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>