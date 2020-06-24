<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>Messages</title>
    <link rel="stylesheet" href="../css/styles.css"/>
</head>
<body>
<?php include "../headerForFirebase.php" ?>
<div id="formWrapperFire">

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
