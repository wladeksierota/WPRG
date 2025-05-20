<?php
define('VISIT_THRESHOLD', 5);
if (isset($_POST['reset'])) {
    setcookie('visit_count', '', time() - 3600, '/');
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}
$visits = isset($_COOKIE['visit_count']) ? intval($_COOKIE['visit_count']) : 0;
$visits++;

setcookie('visit_count', $visits, time() + 86400, '/');
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Licznik wizyt w cookie</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<style>

    .box {
        max-width: 400px;
        margin: 100px auto;
        padding: 20px;
        text-align: center;
        border: solid;
        border-color: black;
    }
    h1 {
        margin-bottom: 10px;
    }
    p {
        font-size: 20px;
        margin: 20px 0;
    }
    .alert{
        background: red;
        border: 1px solid;
        padding: 10px;
        margin-bottom: 20px;
        color: #204020;
    }
    button {
        padding: 10px 20px;
        font-size: 20px;
        border: none;
        background: #3498db;
        cursor: pointer;
    }
    button:hover {
        background: #2980b9;
    }

</style>


<body>
<div class="box">
    <h1>Licznik odwiedzin</h1>
    <p>wizyta numer: <strong><?php echo $visits; ?></strong></p>
    <?php if ($visits >= VISIT_THRESHOLD): ?>
        <div class="alert">
            Strona odwizona już: <?php echo VISIT_THRESHOLD; ?> razy.
        </div>
    <?php endif; ?>
    <form method="post">
        <button type="submit" name="reset">Resetuj licznik</button>
    </form>
</div>
</body>
</html>