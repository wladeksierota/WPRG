<?php

$hasVoted = isset($_COOKIE['voted']);
$voteSubmitted = false;
$selectedOption = '';
$results = [];
$pollQuestion = "Jakie jest twoje ulubione jedzenie?";
$pollOptions = [
    'Pizza',
    'Burger',
    'Kebab',
    'Ciasto',
    'Coca Cola'
];
$resultsFile = 'poll_results.txt';
if (file_exists($resultsFile)) {
    $results = json_decode(file_get_contents($resultsFile), true);
} else {

    foreach ($pollOptions as $key => $value) {
        $results[$key] = 0;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$hasVoted && isset($_POST['vote'])) {
    $selectedOption = $_POST['vote'];
    if (array_key_exists($selectedOption, $pollOptions)) {
        $results[$selectedOption]++;
        file_put_contents($resultsFile, json_encode($results));
        setcookie('voted', '1', time() + 86400 * 30);
        $hasVoted = true;
        $voteSubmitted = true;
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sonda internetowa</title>
    <style>
        body {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        .poll-container {
            background-color: white;
            padding: 25px;
            border-radius: 8px;
        }
        .poll-question {
            font-size: 20px;
            margin-bottom: 20px;
        }
        .poll-options {
            margin-bottom: 20px;
        }
        .poll-option {
            margin-bottom: 10px;
        }
        button {
            background-color: cornflowerblue;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 15px;
        }
        button:hover {
            background-color: darkblue;
        }
        button:disabled {
            background-color: cornflowerblue;
            cursor: not-allowed;
        }
        .message {
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .info {
            background-color: #d1ecf1;
            color: #0c5460;
        }
    </style>
</head>
<body>
<div class="poll-container">
    <h1>Sonda</h1>
    <?php if ($voteSubmitted): ?>
        <div class="message success">
            Głos został oddany.
        </div>
    <?php elseif ($hasVoted): ?>
        <div class="message info">
            Już raz głosowałeś.
        </div>
    <?php endif; ?>
    <div class="poll-question"><?php echo htmlspecialchars($pollQuestion); ?></div>
    <?php if (!$hasVoted): ?>
        <form method="post" class="poll-form">
            <div class="poll-options">
                <?php foreach ($pollOptions as $key => $option): ?>
                    <div class="poll-option">
                        <input type="radio" name="vote" id="<?php echo $key; ?>" value="<?php echo $key; ?>" required>
                        <label for="<?php echo $key; ?>"><?php echo htmlspecialchars($option); ?></label>
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="submit">Głosuj</button>
        </form>
    <?php endif; ?>

</div>
</body>
</html>