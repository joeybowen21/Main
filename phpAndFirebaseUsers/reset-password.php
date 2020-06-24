<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<?php include "header.php" ?>
<div>
    <h1>Reset Password</h1>
    <p>An email will be sent to you.</p>
    <form action="includes/resetRequest.php" method="post">
        <input type="text" name="email" placeholder="Enter your email">
        <button type="submit" name="resetSubmit">Get new password by email</button>
    </form>
    <?php
        if (isset($_GET["reset"])) {
            if ($_GET["reset"] == "success") {
                echo '<p>Check your email.</p>';
            }
        }
    ?>
</div>
