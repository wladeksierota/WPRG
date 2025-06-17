<?php
include("db_conn.php");

if (!isset($conn)) {
    die("Error: variable \$conn has not been loaded from db_conn.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'sentCV') {

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['attachment'])) {
            $fname = $_POST['fname'] ?? '';
            $lname = $_POST['lname'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $message = $_POST['message'] ?? '';

            $file = $_FILES['attachment'];
            $fileContent = null;
            if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['attachment']['tmp_name'];
                $fileContent = addslashes(file_get_contents($fileTmpPath));
            }

            $sql = "INSERT INTO cvs (FirstName, LastName, Message, Email, Phone, File, position) 
        VALUES ('$fname', '$lname', '$message', '$email', '$phone', '$fileContent', 'developer')";

            mysqli_query($conn, $sql);
        }
    }

    if ($action === 'checkCV'){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_rec'] ?? '';

            if (!empty($id) && is_numeric($id)) {
                $sql = "SELECT Status FROM cvs WHERE CV_ID = $id LIMIT 1";
                $result = mysqli_query($conn, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $rc_status = htmlspecialchars($row['Status']);
                }
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <title>mobile-education.pl</title>
        <link rel="icon" type="image/x-icon" href="pngs/logomark_1.png">
        <link rel="stylesheet" href="style/box.css">
        <link rel="stylesheet" href="style/textbox_one.css">
        <link rel="stylesheet" href="style/media.css">
        <link rel="stylesheet" href="style/hamburger_menu.css">
        <link rel="stylesheet" href="style/subpage.css">

        <style>
            .personal{
                font-family: Geist_Regular;
                font-size: 20px;
                margin-top: 30px;
                display: <?php echo (isset($_POST['fname']) ? 'block' : 'none'); ?>;
            }

            .status{
                font-family: Geist_Regular;
                font-size: 20px;
                margin-top: 30px;
                display: <?php echo (isset($_POST['id_rec']) ? 'block' : 'none'); ?>;
            }

        </style>


    </head>
</head>
<body>
<div class = "header">
    <div class="big_logo"><img class="primary-logo" src="pngs/primary logo.png"></div>

    <div class="mid-sec"> </div>
    <div class="right-sec">
        <a href="index.php#UP" class="b">Home</a>
        <a href="index.php#PRO" class="b1">About</a>
        <a href="index.php#SERVICES" class="b1">Services</a>
        <a href="index.php#CAREER" class="b1">Career</a>
        <a href="index.php#TECH" class="b1">Technologies</a>
        <a href="index.php#END" class="b2">Contact --></a>
    </div>
    <label class="hamburger-menu">
        <input type="checkbox">
    </label>
    <aside class="sidebar">
        <nav class="sidebar-buttons">
            <ul>
                <li class="sidebar-element"><a href="index.php#UP" class="sb">Home</a></li>
                <li class="sidebar-element"><a href="index.php#PRO" class="sb">About</a></li>
                <li class="sidebar-element"><a href="index.php#SERVICES" class="sb">Services</a></li>
                <li class="sidebar-element"><a href="index.php#CAREER" class="sb">Career</a></li>
                <li class="sidebar-element"><a href="index.php#TECH" class="sb">Technologies</a></li>
                <li class="sidebar-element"><a href="index.php#END" class="sb">Contact --></a></li>
            </ul>

        </nav>
    </aside>
</div>

<div class="main">


    <a class="admin-button" href="admin_panel.php">Admin login &#8594;</a>
    <h1>PL/SQL / T-SQL Developer</h1>

    <h2 class="p_title">Experience:</h2>
    <ul>
        <li>3+ years of experience in Database programming</li>
        <li>Background in Data Warehouse projects</li>
    </ul>

    <h2 class="p_title">Skills:</h2>
    <ul>
        <li>Knowledge of programmig in PL/SQL or T-SQL</li>
        <li>Experience in queries Optimization (large databases)</li>
        <li>Analytical thinker</li>
        <li>Self starting and well organnized</li>
    </ul>

    <div>
        <h2 class="p_title">Benefits:</h2>
        <ul>
            <li>7k+ PLN monthly (B2B or permanent contract)</li>
            <li>Medical package</li>
        </ul>
    </div>

    <div id="personal" class="personal">
        Here's your personal recruitment ID: <?php
        include("db_conn.php");
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
            $res = mysqli_query($conn, "SELECT CV_ID FROM cvs WHERE Email = '$email' LIMIT 1");
            if ($row = mysqli_fetch_assoc($res)) {
                echo htmlspecialchars($row['CV_ID']);
            } else {
                echo "Error: ID not found";
            }
        }
        ?>
    </div>

    <div id="status" class="status">
        Your recruitment status is: <?php
        if (!isset($rc_status)) {
            echo "There is no such ID";
        }else
            echo $rc_status; ?>
    </div>

    <button id="butt" class="CV1">Send your CV</button>

    <button id="butt2" class="CV2">Check your recruitment status</button>

    <div id="formula2" class="form-container">
        <form method="POST" action="">
            <input type="hidden" name="action" value="checkCV">
            <div class="window">
                <label for="id_rec">ID:</label><br>
                <input type="number" id="id_rec" name="id_rec" placeholder="Type your personal recruitment ID"><br>
            </div>
            <button type="submit" class="subB">Submit</button>
        </form>

    </div>

    <div id="formula1" class="form-container">
        <form method="POST" action="" enctype="multipart/form-data">
            <input type="hidden" name="action" value="sentCV">
            <div class="window">
                <label for="fname">First name:</label><br>
                <input type="text" id="fname" name="fname" placeholder="Jan"><br>
            </div>

            <div class="window">
                <label for="lname">Last name:</label>
                <input type="text" id="lname" name="lname" placeholder="Nowak">
            </div>

            <div class="window">
                <label for="message">Message:</label>
                <textarea class="mess" id="message" name="message" placeholder="Tell us something about you!"></textarea>
            </div>

            <div class="window">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="jan.nowak@example.com" required>
            </div>

            <div class="window">
                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone">
            </div>

            <div class="window">
                <label for="attachment">Attachment (.pdf):</label>
                <input type="file" id="attachment" class="pdf" name="attachment" accept=".pdf" required>
            </div>


            <input id="sub" type="submit" class="subB" value="Submit">

        </form>
    </div>


    <script src="style/script.js"></script>
    <a class="GB" href="index.php#UP">Go back to main page &#8594;</a>

    <p class="R" id="END">© 2025 mobile-education.pl  All rights reserved</p>
</div>
</body>
</html>
