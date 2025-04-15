<?php
   $db_server = "localhost";
    $db_user = "root";
    $db_pass = " ";
    $db_name = "sakiladb";
    $port = 3306;
    $conn = " ";

    $conn = mysqli_connect($db_server, $db_user, $db_pass,$db_name, $port);

    if($conn) {
        echo "Connected successfully";
    }
    else{
        echo "Connection failed";
    }
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

   if(mysqli_num_rows($result) > 0){
       $row = mysqli_fetch_assoc($result);
       echo $row["first_name"]." <br>";
       echo $row["last_name"]. "<br>";
       echo $row["address"]. "<br>";
       echo $row["city"]. "<br>";
       echo $row["district"]. "<br>";
       echo $row["postal_code"]. "<br>";
       echo $row["rental"]. "<br>";
   }



    mysqli_close($conn);


?>
