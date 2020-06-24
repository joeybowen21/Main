<?php
include("db_connection.php");

$query = "SELECT id, firstName, lastName, email, comment, timestamp from contacts
		  ORDER BY timestamp DESC	";
$result = mysqli_query($conn, $query);

$messages = Array();
while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
    if ($row["comment"] < '') {
        $row["comment"] = "No Message Found";
    }

    $messages[] = Array("id" => $row["id"],
        "firstName" => $row["firstName"],
        "lastName" => $row["lastName"],
        "email" => $row["email"],
        "comment" => $row["comment"],
        "timestamp" => $row["timestamp"]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>Messages</title>
    <link rel="stylesheet" href="css/styles.css"/>
</head>
<body>
<?php include "header.php" ?>

<div id="formWrapper">
    <div id="messageContainer">
        <?php
        if (count($messages) < 1) {
            echo '<div class="messageAlert"><b>There are no messages to display.<b></div>';
        }
        foreach ($messages as $message) {
            echo '	<div class="message">
                <div class="messageHeader">' . $message["timestamp"] . ' <span><br>' . $message["firstName"] . ' ' . $message["lastName"] . '<br>' . $message["email"] . '</span></div>
				<b><div class="messageComment">' . $message["comment"] . '</div></b>
				<a class="messageLink" href="mailto:' . $message["email"] . '">Reply</a>
				</div>
				<br>
				<br>';
        }
        ?>
</div>
</div>
</body>
<script src="lib/jquery-3.4.1.min.js"></script>
</html>

