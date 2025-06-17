<?php
include("db_conn.php");

$info = "";

if (!isset($conn)) {
    die("Error: variable \$conn has not been loaded from db_conn.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    foreach ($_POST['records'] as $cv_id => $fields) {
        $cv_id = intval($cv_id);
        $first = mysqli_real_escape_string($conn, $fields['FirstName']);
        $last = mysqli_real_escape_string($conn, $fields['LastName']);
        $email = mysqli_real_escape_string($conn, $fields['Email']);
        $phone = mysqli_real_escape_string($conn, $fields['Phone']);
        $position = mysqli_real_escape_string($conn, $fields['position']);
        $status = mysqli_real_escape_string($conn, $fields['status']);

        $sql = "UPDATE cvs SET 
                    FirstName='$first', 
                    LastName='$last', 
                    Email='$email', 
                    Phone='$phone', 
                    position='$position', 
                    status='$status' 
                WHERE CV_ID=$cv_id";
        mysqli_query($conn, $sql);
    }

    echo "<p style='color: green;'>Changes saved.</p>";
}

// Pobieranie danych
$result = mysqli_query($conn, "SELECT * FROM cvs");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit All Records</title>
    <link rel="stylesheet" href="style/editor_style.css">
</head>
<body>

<h2>Edit Records</h2>

<form method="POST" action="">
    <table>
        <thead>
        <tr>
            <th>CV_ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Position</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr class="data">
                <td><?= $row['CV_ID'] ?></td>
                <td><input type="text" name="records[<?= $row['CV_ID'] ?>][FirstName]" value="<?= htmlspecialchars($row['FirstName']) ?>"></td>
                <td><input type="text" name="records[<?= $row['CV_ID'] ?>][LastName]" value="<?= htmlspecialchars($row['LastName']) ?>"></td>
                <td><input type="email" name="records[<?= $row['CV_ID'] ?>][Email]" value="<?= htmlspecialchars($row['Email']) ?>"></td>
                <td><input type="text" name="records[<?= $row['CV_ID'] ?>][Phone]" value="<?= htmlspecialchars($row['Phone']) ?>"></td>
                <td><input type="text" name="records[<?= $row['CV_ID'] ?>][position]" value="<?= htmlspecialchars($row['position']) ?>"></td>
                <td><input type="text" name="records[<?= $row['CV_ID'] ?>][status]" value="<?= htmlspecialchars($row['status']) ?>"></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    <br>
    <button type="submit" name="update">Save changes</button>
</form>

</body>
</html>