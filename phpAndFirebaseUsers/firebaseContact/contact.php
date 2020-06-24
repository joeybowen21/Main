<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Firebase</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<?php include "../headerForFirebase.php"?>
<div id="formWrapper">
    <div id="alert">Thanks for your feedback.</div>
        <form id="contactForm">
            <h2 class="title">Contact Us</h2>
            <div class="inputs">
                <label class="label">First Name</label>
                <input class="formInput" type="text" name="firstName" id="firstName" placeholder="First Name" required>
            </div>

            <div class=inputs">
                <label class="label">Last Name</label>
                <input class="formInput" type="text" name="lastName" id="lastName" placeholder="Last Name" required>
            </div>

            <div class="inputs">
                <label class="label">E-mail</label>
                <input class="formInput" type="email" name="email" id="email" placeholder="E-mail Address required">
            </div>

            <div class="inputs">
                <label class="label">Comment</label>
                <input class="formInput" name="comment" id="comment" placeholder="Type comments here" required>
            </div>

            <div class="inputs">
                <input id="submitContact" type="submit" />
            </div>
        </form>
</div>
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
</script>
<script src="firebaseContact.js"></script>
</body>
</html>
