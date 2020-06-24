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
    <?php
    //Grab tokens in url
        $selector = $_GET["selector"];
        $validator = $_GET["validator"];
        //Check if tokens are empty
        if (empty($selector) || empty($validator)) {
            echo "Failure. Request could not be completed.";
        } else {
            //Check if they are the correct tokens
            if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
                ?>
                <form action="includes/resetPassword.php" method="post">
                    <input type="text" type="hidden" name="selector" value="<?php echo $selector?>">
                    <input type="text" type="hidden" name="validator" value="<?php echo $validator?>">
                    <input type="password" name="pwd" placeholder="Enter a password...">
                    <input type="password" name="pwdRepeat" placeholder="Repeat Password...">
                    <button type="submit" name="resetPasswordSubmit">Reset Password</button>
                </form>
            <?php
            }
        }
    ?>
</div>
