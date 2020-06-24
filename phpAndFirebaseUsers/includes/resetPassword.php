<?php
//Grab all fields from createNewPassword.php
if (isset($_POST["resetPasswordSubmit"])) {
    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $password = $_POST["pwd"];
    $passwordRepeat = $_POST["pwdRepeat"];

    //If fields are empty
    if (empty($password) || empty($passwordRepeat)) {
        header("Location../reset-password.php?newpwd=empty");
        exit();
    } elseif ($password != $passwordRepeat) {
        header("Location: ../createNewPassword.php?newpwd=pwdnotthesame");
        exit();
    }

    //Get current date
    $currentDate = date("U");

    //Require database
    require '../db_connection.php';
    //Grab tokens from database
    $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpires >= ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There was an error";
        exit();
    } else {
        //Check for parameters from sql statement
        mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
        mysqli_stmt_execute($stmt);

        //Grab result
        $result = mysqli_stmt_get_result($stmt);
        if (!$row = mysqli_fetch_assoc($result)) {
            echo "Resubmit your reset request";
            exit();
        } else {
            //Make sure tokens are in correct format
            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

            //Check for error
            if ($tokenCheck === false) {
                echo "Resubmit reset request";
                exit();
                //Get row from reset table
            } elseif ($tokenCheck === true) {
                $tokenEmail = $row['pwdResetEmail'];
                //Select user from users table based on email
                $sql = "SELECT * FROM users WHERE emailUsers=?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "There was an error";
                    exit();
                } else {
                    //Bind parameters for sql replacement "?"
                    mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                    mysqli_stmt_execute($stmt);
                    //Grab result
                    $result = mysqli_stmt_get_result($stmt);
                    if (!$row = mysqli_fetch_assoc($result)) {
                        echo "There was an error";
                        exit();
                    } else {

                        //Update user table password
                        $sql = "UPDATE users SET pwdUsers=? WHERE emailUsers=?";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            echo "There was an error";
                            exit();
                        } else {
                            //Hash password
                            $newHash = password_hash($password, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "s", $newHash, $tokenEmail);
                            mysqli_stmt_execute($stmt);

                            //Delete token from table
                            $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
                            $stmt = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                echo "There was an error";
                                exit();
                            } else {
                                mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                                mysqli_stmt_execute($stmt);
                                header("Location ../phpUser.php?newpwd=passwordupdated");
                            }
                        }
                    }
                }
            }
        }
    }

} else {
    header("Location: ../index.php");
}
