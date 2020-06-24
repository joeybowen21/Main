<?php
session_start();
require "../db_connection.php";

if (!isset($_POST['email'], $_POST['password'])) {
    //Email and password data not complete
    die ('Fill out both fields!');
}

if ($stmt = $conn->prepare('SELECT id, password FROM users WHERE email = ?')) {
    //Bind parameters. Email is a string so use "s" as stype
    $stmt->bind_param('s', $_POST['email']);
    $stmt->execute();
    //Store the result
    $stmt->store_result();
}

if ($stmt->num_rows > 0) {
    //If rows returned is greater than 0, bind $id and $password parameters. Then fetch the results from the bind.
    $stmt->bind_result($id, $password);
    $stmt->fetch();
    //Verify the hashed password
    if (password_verify($_POST['password'], $password)) {
        //Create sessions to remember user
        session_regenerate_id();
        $_SESSION['loggedIn'] = TRUE;
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['id'] = $id;
        echo 'Hello ' . $_SESSION['email'] . '!';
    } else {
        echo 'Incorrect password!';
    }
} else {
    echo 'Incorrect email!';
}

echo "<br><a style='color: black' href=\"../phpUser.php\"> Go back to Previous Page </a>";
$stmt->close();


