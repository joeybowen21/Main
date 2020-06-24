<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<?php include "header.php" ?>

<div class="wrapper">
    <h3>Sign up with email and password</h3>
    <form style="margin-bottom: 50px;" id="signUpForm">
        Email:
        <input id="suEmail" type="email" name="email" />
        Password:
        <input id="suPassword" type="password" name="password" />
        <input type="submit" id="suSubmit" value="Sign Up" />
    </form>

    <h3>Sign In with email and password</h3>
    <form id="signInForm">
        Email:
        <input id="siEmail" type="email" name="email" />
        Password:
        <input id="siPassword" type="password" name="password" />
        <input type="submit" id="siSubmit" value="Sign In" />
    </form>

    <button class="googleSignIn" onclick="googleSignIn()">Sign in with Google</button>

    <form id="passwordReset">
        <input id="resetEmail" type="email" placeholder="Enter email to reset password">
        <input type="submit" class="resetPassword" value="Reset Password">
    </form>

</div>

<div style=" margin-top: 50px;" class="status"></div>

<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/6.6.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/6.6.2/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/6.6.2/firebase-database.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->

<script>
    // Your web app's Firebase configuration
    var firebaseConfig = {
        apiKey: "AIzaSyAt4QbrFVwqkIL_raWyHMxSkd-aFbuBy-w",
        authDomain: "n423-contact.firebaseapp.com",
        databaseURL: "https://n423-contact.firebaseio.com",
        projectId: "n423-contact",
        storageBucket: "",
        messagingSenderId: "208548931310",
        appId: "1:208548931310:web:4e40c98ec93392c7a8b5ff"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);

    //Make auth references
    let auth = firebase.auth();
    let db = firebase.database();
</script>
<script src="app/auth.js"></script>
</body>
</html>
