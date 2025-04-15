<?php
   $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "sakila";
    $port = 3306;
    $conn = "";

    $conn = mysqli_connect($db_server, $db_user, $db_pass,$db_name, $port);

    if($conn) {
        echo "Connected successfully";
    }
    else{
        echo "Connection failed";
    }
$sql = "
SELECT 
    c.first_name,
    c.last_name,
    a.address,
    ci.city,
    a.district,
    a.postal_code,
    GROUP_CONCAT(DISTINCT f.title ORDER BY f.title SEPARATOR ', ') AS rental
FROM customer c
JOIN address a ON c.address_id = a.address_id
JOIN city ci ON a.city_id = ci.city_id
JOIN rental r ON c.customer_id = r.customer_id
JOIN inventory i ON r.inventory_id = i.inventory_id
JOIN film f ON i.film_id = f.film_id
GROUP BY c.customer_id
ORDER BY c.last_name, c.first_name;
";
   $result= mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
   <head>
         <title>View Customers</title>
   </head>
<body>
      <h1> Customer List</h1>
   <table border="1" cellpadding="5">
      <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Address</th>
            <th>City</th>
            <th>District</th>
            <th>Postal Code</th>
            <th>Films Rented</th>
      </tr>
<?php
   if(mysqli_num_rows($result) > 0){
       while ($row = mysqli_fetch_assoc($result)) {
       echo "<tr>"; 
       echo "<td>" . htmlspecialchars($row["first_name"])." <br>";
       echo "<td>" . htmlspecialchars($row["last_name"]). "<br>";
       echo "<td>" . htmlspecialchars($row["address"]). "<br>";
       echo "<td>" . htmlspecialchars($row["city"]). "<br>";
       echo "<td>" . htmlspecialchars($row["district"]). "<br>";
       echo "<td>" . htmlspecialchars($row["postal_code"]). "<br>";
       echo "<td>" . htmlspecialchars($row["rental"]). "<br>";
       echo "</tr>"; 
      }
   }   
      else 
      {
         echo "<tr><td colspan='7'>No customers found.</td></tr>";
      }
    mysqli_close($conn);
?>
      
</table>  
<br>
   <button onclick="window.location.href='manager.html'">Back to Manager Page</button>
</body>
</html>


