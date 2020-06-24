<?php
include("../db_connection.php");

function sanitize($item) {
    global $conn;
    $item = html_entity_decode($item);
    $item = trim($item);
    $item = stripslashes($item);
    $item = strip_tags($item);
    $item = mysqli_real_escape_string($conn, $item);
    return $item;
}

$firstName = '';
$lastName = '';
$email = '';
$comment = '';
if (isset($_REQUEST["firstName"])) {
    $firstName = sanitize($_REQUEST["firstName"]);
}
if (isset($_REQUEST["lastName"])) {
    $lastName = sanitize($_REQUEST["lastName"]);
}
if (isset($_REQUEST["email"])) {
    $email = sanitize($_REQUEST["email"]);
}
if (isset($_REQUEST["comment"])) {
    $comment = sanitize($_REQUEST["comment"]);
}


$sql = "INSERT INTO `contacts` (`id`, `firstName`, `lastName`, `email`, `comment`, timestamp) 
		VALUES (NULL, '" . $firstName . "', '" . $lastName . "', '" . $email . "', '" . $comment . "', NULL)";

$result = mysqli_query($conn, $sql);

if (mysqli_affected_rows($conn) == 1) {
    $success = true;
} else {
    $success = false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>Contact Confirmation</title>
    <link rel="stylesheet" href="../css/styles.css"/>
</head>
<body>
<div class="formWrapper"></div>
<div id="messageBody">
    <?php
    if ($success) {
        echo '<p>Thanks for submitting your feedback.</p>';
    } else {
        echo '<p>An error has occurred. Please contact an administrator.</p>';
    }
    ?>
</div>
<div id="addContactLink">
    <a href="../index.php"><h2>Return to Home</h2></a>
</div>
</div>
</body>
</html>
