<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

$error_message = '';
if (isset($_GET['error'])) {
    switch ($_GET['reason']) {
        case 'incorrect_password':
            $error_message = 'Invalid password. Please try again.';
            break;
        case 'user_not_found':
            $error_message = 'Username not found. Please try again.';
            break;
        case 'invalid_request':
            $error_message = 'Invalid request method.';
            break;
        default:
            $error_message = 'Unknown error. Please try again.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color:#E9F1FA;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-box {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 360px;
            padding: 20px;
            text-align: center;
        }
        .login-box h1 {
            margin-bottom: 20px;
            color: #333;
        }
        .login-box .form-control {
            margin-bottom: 15px;
            border-radius: 6px;
        }
        .login-box .btn-primary {
            width: 100%;
            padding: 12px;
        }
        .login-box .error-message {
            color: red;
            margin-bottom: 15px;
        }
        #login-top-header img{
            position: absolute;
            top: 15%;
            text-transform: capitalize;
            font-weight: 699;
            height: 100px;
            width: auto;

        }
        #login-top-header
        {
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="login-box">
    <h1 id="login-top-header"><img src="images/logo.png" alt="logo"></h1>
        <h1>Login</h1>
        <?php if ($error_message): ?>
            <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>
        <form action="login.php" method="post">
            <input type="text" class="form-control" name="username" placeholder="Enter your Username" required>
            <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <p class="mt-3">Don't have an account? <a href="signup.php">Sign up</a></p>
    </div>
</body>
</html>
