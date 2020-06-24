<?php

if (isset($_POST["resetSubmit"])) {
    //2 Tokens
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    //Change url based on server
    $url = "http://localhost/N423/Homework1/createNewPassword.php?selector=" . $selector . "&validator=" . bin2hex($token);
    //$url = "https://in-info-web4.informatics.iupui.edu/~jobbowen/Homework1/createNewPassword.php?selector=" . $selector . "&validator=" . bin2hex($token);
    //Set expire date
    $expires = date("U") + 1800;

    //Connect to database
    require '../db_connection.php';

    //Grab email from form
    $userEmail = $_POST["email"];

    //Delete multiple tokens
    $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There was an error";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $userEmail);
        mysqli_stmt_execute($stmt);
    }

    //Insert tokens into database
    $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There was an error";
        exit();
    } else {
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
        mysqli_stmt_execute($stmt);
    }

    mysqli_stmt_close($stmt);

    //Send Email
    $to = $userEmail;
    $subject = 'Reset your password';
    $message = '<p>The link to reset your password is below.</p>';
    $message .= '<p>Here is your password reset link: </br>';
    $message .= '<a href="' . $url . '">' . $url . '</a></p>';

    $headers = "From: N423 <n423@gmail.com>\r\n";
    $headers .= "Reply-To: n423@gmail.com\r\n";
    $headers .= "Content-type: text/html\r\n";

    mail($to, $subject, $message, $headers);

    header("Location: ../reset-password.php?reset=success");

} else {
    header("Location: ../index.php");
}
