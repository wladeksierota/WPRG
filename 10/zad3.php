<?php
session_start();

$correct_login = "admin";
$correct_password = "haslo";

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($login === $correct_login && $password === $correct_password) {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $login;
    } else {
        $error = "Błędny login lub hasło";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>logowanie</title>
</head>
<body>

<?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
    <div class="success">
        <p>Zalogowano poprawnie jako: <strong><?= $_SESSION['username'] ?></strong></p>
        <p><a href="?logout=1">Wyloguj</a></p>
    </div>
<?php else: ?>
    <h1>Logowanie</h1>

    <?php if (isset($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="post">
        <div>
            <label for="login">Login:</label>
            <input type="text" id="login" name="login" required>
        </div>

        <div>
            <label for="password">Hasło:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <button type="submit">Zaloguj</button>
    </form>
<?php endif; ?>

</body>
</html>
