<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<?php include "header.php" ?>

<div style="margin-bottom: 20px;" class="wrapper">
    <h3>SIGN UP</h3>
    <form action="includes/signUp.php" id="signUpForm" method="post">
        Username:
        <input id="suUsername" type="text" name="username" placeholder="Username"/>
        Email:
        <input id="suEmail" type="email" name="email" placeholder="Email"/>
        <br>Password:
        <input id="suPassword" type="password" name="password" placeholder="Password"/>
        <input id="suPasswordRepeat" type="password" name="passwordRepeat" placeholder="Repeat Password"/>
        Role (1-2):
        <input id="suRole" type="number" name="role" placeholder="Role (1-2)"/>
        <button type="submit" id="suSubmit" name="suSubmit" value="Sign Up">Sign Up</button>
    </form>

    <h3 style="margin-top: 20px">SIGN IN</h3>
    <?php
    if (isset($_GET["newpwd"])) {
        if ($_GET["newpwd"] == "passwordupdated") {
            echo '<p>Your password has been reset.</p>';
        }
    }
    if (isset($_SESSION['id'])) {
        echo '<form action="includes/logout.php" method="post">
            <button type="submit" name="logout">Logout</button>
</form>';
    }

    else {
        echo '    <form action="includes/login.php" id="signInForm" method="post">
        Email:
        <input id="siEmail" type="email" name="email" placeholder="Email"/>
        Password:
        <input id="siPassword" type="password" name="password" placeholder="Password"/>
        <button type="submit" name="login" id="login">Login</button>
    </form>
    <a style="color: #000000" href="reset-password.php">Forgot Password?</a>';
    }
    ?>
</div>


<div>
    <?php
        if (isset($_SESSION['id'])) {
            echo '<h1>You are logged in</h1>';
        }

        else {
            echo '<h1>You are logged out</h1>';
        }
    ?>
</div>
