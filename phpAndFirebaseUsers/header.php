<?php
session_start();
?>
<!-- Header File -->
<div class="header"><span>Welcome to the Conference</span></div>
<div class="navbar">
    <a href="index.php" class="active">Home</a>
    <a href="speakers.php" class="active">Speakers PHP</a>
    <a href="speakersJSON.php" class="active">Speakers JSON</a>
    <a href="contact.php" class="active">Contact PHP</a>
    <a href="firebaseContact/contact.php">Contact Firebase</a>
    <?php
    if (isset($_SESSION['id'])) {
        echo '<a href="messages.php" class="active">Messages PHP</a>';
        echo '<a href="firebaseContact/messagesFirebase.php">Messages Firebase</a>';
    }
    ?>
    <a href="phpUser.php">Php Users</a>
    <a href="firebaseUser.php">Firebase Users</a>
    <a href="#" name="logout" id="logout">LogoutFirebase</a>
</div>

<script src="app/app.js"></script>
