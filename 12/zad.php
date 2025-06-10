<?php
$connect = mysqli_connect("localhost", "root", "", "nazwa_1");

$query = "CREATE TABLE IF NOT EXISTS Student(StudentID int PRIMARY KEY auto_increment,
    FirstName varchar(255) NOT NULL,
    SecondName varchar(255) NOT NULL,
    Salary int NOT NULL,
    DateOfBirth date NOT NULL)";

if(mysqli_query($connect, $query)){
    echo "Table Students created successfully";
} else{
    echo "ERROR: Could not able to execute";
}

$q1 = "DROP TABLE IF EXISTS Student";

if(isset($_GET["butt"])){
    mysqli_query($connect, $q1);
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Manage MySQL Table</h1>

<form method="GET">
    <button type="submit" name="butt">ihwfquwb</button>
</form>
</body>
</html>
