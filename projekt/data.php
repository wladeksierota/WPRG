<?php
session_start();
include("db_conn.php");

$info = "";

if (!isset($conn)) {
    die("Error: variable \$conn has not been loaded from db_conn.php");
}

$sql = "SELECT CV_ID, FirstName, LastName, Email, Phone, position, status FROM cvs";
$result = mysqli_query($conn, $sql);


$chart_data = mysqli_query($conn, "SELECT position, COUNT(*) as count FROM cvs GROUP BY position");
$chart_result = [];
while ($row = mysqli_fetch_assoc($chart_data)) {
    $chart_result[$row['position']] = $row['count'];
}

$total = array_sum($chart_result);
$percentages = [];
foreach ($chart_result as $position => $count) {
    $percentages[$position] = round(($count / $total) * 100);
}

$colors = ['analyst' => '#ffce56', 'developer' => '#36a2eb', 'project manager' => '#ff6384'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $operation = $_POST['operation'] ?? '';

        if($operation === "edit"){
            if ($_SESSION['access'] !== 'admin' && $_SESSION['access'] !== 'editor') {
                $info = "Access denied, you must be an admin or an editor to edit records.";
            }
            else{
                header("Location: editor_view.php");
                exit;
            }
        }

        if($operation === "delete"){
            if ($_SESSION['access'] !== 'admin') {
                $info = "Access denied, you must be an admin to delete records.";
            }
            elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cv_id'])) {
                $cv_id = intval($_POST['cv_id']);

                $sql = "DELETE FROM cvs WHERE CV_ID = $cv_id";
                if (mysqli_query($conn, $sql)) {
                    $info = "Successfully deleted the record. Please refresh the page.";
                } else {
                    $info = "Error occured while deleting record";
                }
            }
        }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/data_style.css">
    <title>Data Table</title>
    <style>
        .pie-chart {
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: conic-gradient(
                <?php
                $current_percent = 0;
                foreach ($percentages as $position => $percent) {
                    echo "{$colors[$position]} {$current_percent}% " . ($current_percent + $percent) . "%,";
                    $current_percent += $percent;
                }
                ?>
                #eee 0%
            );
            margin: 20px auto;
        }
    </style>
</head>
<body>


<form method="POST" action="" style="display:inline;">
    <input type="hidden" name="operation" value="edit">
    <button class="edit_button" type="submit">EDIT</button>
</form>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
    <tr>
        <th>CV ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Position</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr class="rec">
                <td><?= htmlspecialchars($row['CV_ID']) ?></td>
                <td><?= htmlspecialchars($row['FirstName']) ?></td>
                <td><?= htmlspecialchars($row['LastName']) ?></td>
                <td><?= htmlspecialchars($row['Email']) ?></td>
                <td><?= htmlspecialchars($row['Phone']) ?></td>
                <td><?= htmlspecialchars($row['position']) ?></td>
                <td><?= htmlspecialchars($row['status']) ?></td>
                <td>
                    <form method="POST" action="" style="display:inline;">
                        <input type="hidden" name="operation" value="delete">
                        <input type="hidden" name="cv_id" value="<?= $row['CV_ID'] ?>">
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="8">No records in the database.</td></tr>
    <?php endif; ?>
    </tbody>
</table>
<?php if (strlen($info) > 0): ?>
    <div class="error"><?php echo $info; ?></div>
<?php endif; ?>


<h2 class="distribution">Distribution of applications for positions</h2>

<div class="pie-chart"></div>

<div class="legend">
    <?php
    foreach ($percentages as $position => $percent) {
        echo '<div class="legend-item">';
        echo '<div class="legend-color" style="background-color: '.$colors[$position].'"></div>';
        echo '<span>'.$position.' ('.$percent.'%)</span>';
        echo '</div>';
    }
    ?>
</div>

</body>
</html>

