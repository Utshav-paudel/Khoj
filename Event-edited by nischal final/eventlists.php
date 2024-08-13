<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

require_once 'db_connection.php';

// Fetch all events
$stmt = $conn->prepare("SELECT * FROM events ORDER BY start_date ASC");
$stmt->execute();
$result = $stmt->get_result();
$events = [];
while ($row = $result->fetch_assoc()) {
    $events[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Events</title>
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

        .btn-back {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            text-align: center;
            display: inline-block;
            transition: background-color 0.3s;
            margin: 20px auto;
            display: block;
        }

        .btn-back:hover {
            background-color: #0056b3;
        }

        .btn-back:focus {
            outline: none;
        }

        .container {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .event-card {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
            width: 100%;
            max-width: 800px;
        }

        .event-card:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .event-card h5 {
            margin-top: 0;
            font-size: 24px;
            font-weight: bold;
            color: #333;
            text-transform: uppercase; 
        }

        .event-card p {
            color: #555;
            font-size: 18px;
            line-height: 1.6;
            text-transform: capitalize;
        }

        .event-card a {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 8px 16px;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s;
        }

        .event-card a:hover {
            background-color: #0056b3;
        }

        .event-card a:focus {
            outline: none;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>All Events</h1>
    </div>
    <div class="container">
        <a href="dashboard.php" class="btn-back">Back to Dashboard</a>
        <?php if ($events): ?>
            <?php foreach ($events as $event): ?>
                <div class="event-card">
                    <h5><?php echo htmlspecialchars($event['name']); ?></h5>
                    <p><?php echo htmlspecialchars($event['description']); ?></p>
                    <a href="event_details.php?id=<?php echo $event['id']; ?>">View Details</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No events found.</p>
        <?php endif; ?>
    </div>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
