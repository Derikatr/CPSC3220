<?php

$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "sakila";
$port = 3306;

$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name, $port);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$title = $_POST['title'];
$description = $_POST['description'];
$release_year = $_POST['release_year'];
$language_id = $_POST['language_id'];
$rental_duration = $_POST['rental_duration'];
$rental_rate = $_POST['rental_rate'];
$length = $_POST['length'];
$replacement_cost = $_POST['replacement_cost'];
$rating = $_POST['rating'];
$special_features = $_POST['special_features'];


$sql = "
INSERT INTO film 
(title, description, release_year, language_id, rental_duration, rental_rate, length, replacement_cost, rating, special_features)
VALUES 
('$title', '$description', $release_year, $language_id, $rental_duration, $rental_rate, $length, $replacement_cost, '$rating', '$special_features');
";


?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Film Result</title>
</head>
<body>
    <h1>Add Film Result</h1>
    <?php
    if (mysqli_query($conn, $sql)) {
        echo "<p style='color: green;'>Film added successfully!</p>";
    } else {
        echo "<p style='color: red;'>Error adding film: " . mysqli_error($conn) . "</p>";
    }
    mysqli_close($conn);
    ?>
    <br>
    <button onclick="window.location.href='manager.html'">Back to Manager Page</button>
</body>
</html>
