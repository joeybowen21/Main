<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Contact PHP</title>
    <link rel="stylesheet" href="css/styles.css"/>
</head>
<body>
<?php include "header.php" ?>

<div id="formWrapper">
        <form id="contactForm" method="post" action="php/add_contact.php">
            <h2 class="title">Contact Us</h2>
            <div class="inputs">
                <label class="label">First Name</label>
                <input class="formInput" type="text" name="firstName" id="firstName" placeholder="First Name" required>
            </div>

            <div class="inputs">
                <label class="label">Last Name</label>
                <input class="formInput" type="text" name="lastName" id="lastName" placeholder="Last Name" required>
            </div>

            <div class="inputs">
                <label class="label">E-mail</label>
                <input class="formInput" type="email" name="email" id="email" placeholder="E-mail Address" required>
            </div>

            <div class="inputs">
                <label class="label">Comment</label>
                <input class="formInput" name="comment" id="comment" placeholder="Type comments here">
            </div>

            <div class="inputs">
                <input id="submitContact" type="submit"/>
            </div>
        </form>
</div>
</body>
</html>
