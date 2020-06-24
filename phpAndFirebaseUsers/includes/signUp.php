<?php
//If suSubmit has been clicked/posted run the function. Else redirect to phpUser.php
if (isset($_POST['suSubmit'])) {
    require '../db_connection.php';

    //Store all post data from form in variables
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['passwordRepeat'];
    $role = $_POST['role'];

    //If any fields are empty throw an empty fields error
    if (empty($username) || empty($email)|| empty($password) || empty($passwordRepeat  || empty($role))) {
        header("Location: ../phpUser.php?error=emptyfields&username=".$username."&email=".$email."&role=".$role);
        exit();
    }
    //Validate and filter email and searches $username for letters and numbers only. preg_match returns true or false
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../phpUser.php?error=invalidusername&email=".$email);
        exit();
    }
    //Check if email is valid
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../phpUser.php?error=invalidemail&username=".$username);
        exit();
    }
    //Search $username for letters and number only. Returns true or false
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../phpUser.php?error=invalidusername&email=".$email);
        exit();
    }
    //If passwords entered match, return true.
    else if ($password !==$passwordRepeat) {
        header("Location: ../phpUser.php?error=passwordcheck&email=".$email."&username=".$username);
        exit();
    }
    //If all above is correct connect to database and select username. Initialize statement and return an object.
    else {
        $sql = "SELECT username FROM users WHERE username=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../phpUser.php?error=sqlerror");
            exit();
        }
        //Bind $username to $stmt which is a string ("s") and store the result in $resultCheck
        else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
        }
        //If $resultCheck is > 0 (aka not a username) throw an error
        if ($resultCheck > 0) {
            header("Location: ../phpUser.php?error=usertaken&email=".$email);
            exit();
        }
        //Insert form data into the database table. Store connection to database in $stmt then pass it to prepare statement for execution
        else {
            $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../phpUser.php?error=sqlerror");
                exit();
            }
            //Create and then store password as hashed password. Bind all form parameters as string type. Execute the statement.
            else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $hashedPassword, $role);
                mysqli_stmt_execute($stmt);
                header("Location: ../phpUser.php?signUp=success");
                exit();
            }
        }
    }
    //Close connections
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

//Redirect if submit button wasn't clicked.
else {
    header("Location: ../phpUser.php");
    exit();
}
