<?php
session_start();
include("db_conn.php");

if (!isset($conn)) {
    die("Error: variable \$conn has not been loaded from db_conn.php");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $sql = "SELECT * FROM admin_table WHERE login = '$username' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        if ($user['password'] === $password) {
            $_SESSION['user_id'] = $user['ID'];
            $_SESSION['access'] = $user['access'];
            header("Location: data.php");
            exit;
        }
    }

    $error = "INCORRECT USERNAME OR PASSWORD";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Panel</title>
    <title>mobile-education.pl</title>
    <link rel="icon" type="image/x-icon" href="pngs/logomark_1.png">
    <link href="https://fonts.googleapis.com/css2?family=Helvetica:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/ap.css"
    <link rel="stylesheet" href="style/subpage.css">

</head>
<body>

<div class="login-container">
    <h2>Login</h2>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Log In</button>

        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
    </form>
</div>

</body>
</html>

