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

$required_fields = [
    'title', 'description', 'release_year', 'language_id',
    'rental_duration', 'rental_rate', 'length',
    'replacement_cost', 'rating', 'special_features'
];

foreach ($required_fields as $field) {
    if (!isset($_POST[$field])) {
        die("Missing required field: $field");
    }
}


$title = $_POST['title'];
$description = $_POST['description'];
$release_year = (int)$_POST['release_year'];
$language_id = (int)$_POST['language_id'];
$rental_duration = (int)$_POST['rental_duration'];
$rental_rate = (float)$_POST['rental_rate'];
$length = (int)$_POST['length'];
$replacement_cost = (float)$_POST['replacement_cost'];
$rating = $_POST['rating'];
$special_features = $_POST['special_features'];


$stmt = $conn->prepare("
    INSERT INTO film 
    (title, description, release_year, language_id, rental_duration, rental_rate, length, replacement_cost, rating, special_features)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

$stmt->bind_param("ssiiiiddss", 
    $title, $description, $release_year, $language_id, 
    $rental_duration, $rental_rate, $length, 
    $replacement_cost, $rating, $special_features
);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Film Result</title>
</head>
<body>
    <h1>Add Film Result</h1>
    <?php
    if ($stmt->execute()) {
        echo "<p style='color: green;'>Film added successfully!</p>";
    } else {
        echo "<p style='color: red;'>Error adding film: " . $stmt->error . "</p>";
    }

    $stmt->close();
    mysqli_close($conn);
    ?>
    <br>
    <button onclick="window.location.href='manager.html'">Back to Manager Page</button>
</body>
</html>
