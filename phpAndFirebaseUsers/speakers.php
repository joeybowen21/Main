<html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><body>
<link rel="stylesheet" href="css/styles.css">
<?php include "header.php"; ?>

<div class="container">
<table id="phpTable">
<tr>
    <th id="phpTableImage"></th>
    <th id="phpTableName"></th>
    <th id="phpTableDescription"></th>
</tr>

<?php
include 'db_connection.php';
//Select data from database and table
$sql = "SELECT id, image, name, description FROM people";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr><td><img src="' .$row["image"].'" width="150" height="150"/></td><td>' . $row["name"] .'</td><td>' . $row["description"] . '</td></tr>';
    }
    echo "</table>";
} else {
    echo "No Results";
}
$conn-> close();

?>
</table>
</div>
</body>
</html>
