<?php
$customers= 100;
$order = 350;
$product = 750;
$order_item = 550;
$address = 250;
$warehouse = 25;
$product_warehouse = 1250;

function getAddress($id){
    $streets= ["Parker Street", '3rd Street', 'Main Street', 'Market Street', 'Walnut Street', 'McKenzie Street', 'Vine Street', 'Oak Street'];
    $cities= ['Washington'];
    $states= ['New Jersey', 'Virginia', 'Pennsylvania', 'Mississippi', 'Massachusetts' ];

    $zip = rand(00000,99999);
    $street = $streets[array_rand($streets)] . " " . rand(1,999);
    $city = $cities[array_rand($cities)];
    $state = $states[array_rand($states)];

    return "INSERT INTO address (address_id, street, city, state, zip) VALUES ($id, '$street', '$city', '$state', '$zip');";
}

function getCustomer($id){
    $first_names = ['Gerald', 'Samantha', "Barbra", "Maria", "Bob", "Trey", "Darion", "Candy"] ;
    $last_names = ["Smith", "Johnson", "Wilson", "Peterson", "Jefferson", "Jackson"];

    $first_name = $first_names[array_rand($first_names)];
    $last_name = $last_names[array_rand($last_names)];
    $email = strtolower($first_names[array_rand($first_names)]) . "." . strtolower($last_names[array_rand($last_names)]) . "@".(rand(0, 1) ? "gmail" : "yahoo") . ".com";
    $phone = sprintf("(%03d) %03d - %04d", rand(100, 999), rand(100, 999), rand(100, 999));
    $address_id= rand(1,999);


    return "INSERT INTO customer (customer_id, first_name, last_name, email, phone, address_id) VALUES ($id, '$first_name', '$last_name', '$email', '$phone', $address_id);";
}

function getProduct($id){
    $product_names= ["table", "couch", "dresser", "chair", "bed"];
    $descriptions = ["Great for sitting", "Great for eating", "Family Friendly", "Storage"];

    $product_name = $product_names[array_rand($product_names)];
    $description = $descriptions[array_rand($descriptions)];
    $weight = rand(100, 500);
    $base_cost = rand(100, 9999);


    return "INSERT INTO product (product_id, product_name, description, weight, base_cost) VALUES ($id, '$product_name', '$description', $weight, $base_cost);";
}
?>
