<?php
session_start();
require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: dashboard.php");
            exit();
        } else {
            header("Location: index.php?error=true&reason=incorrect_password");
            exit();
        }
    } else {
        header("Location: index.php?error=true&reason=user_not_found");
        exit();
    }
} else {
    header("Location: index.php?error=true&reason=invalid_request");
    exit();
}
?>
