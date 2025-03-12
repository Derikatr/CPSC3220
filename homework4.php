<?php
$customers = 100;
$order = 350;
$product = 750;
$order_item = 550;
$address = 250;
$warehouse = 25;
$product_warehouse = 1250;

$cities = file("cities.txt", FILE_IGNORE_NEW_LINES);
$email = file("domains.txt", FILE_IGNORE_NEW_LINES);
$first_names = file("first_names.txt", FILE_IGNORE_NEW_LINES);
$last_names = file("last_names.txt", FILE_IGNORE_NEW_LINES);
$products = file("products.txt", FILE_IGNORE_NEW_LINES);
$states = file("states.txt", FILE_IGNORE_NEW_LINES);
$streets = file("street_names.txt", FILE_IGNORE_NEW_LINES);
$streetTypes = file("street_types.txt", FILE_IGNORE_NEW_LINES);

function getAddress($cities, $streets, $states){
    $zip = rand(10000, 99999); 
    $street = rand(1, 999) . $streets[array_rand($streets)] . $streetTypes[array_rand($streetTypes)];
    $city = $cities[array_rand($cities)];
    $state = $states[array_rand($states)];

    return "INSERT INTO address (address_id, street, city, state, zip) VALUES ($id, '$street', '$city', '$state', '$zip');";
}

function getCustomer($first_names, $last_names, $domains){
    $first_name = $first_names[array_rand($first_names)];
    $last_name = $last_names[array_rand($last_names)];
    $email = strtolower($first_name) . "." . strtolower($last_name) . "@" . $domains[array_rand($domains)];
    $phone = sprintf("(%03d) %03d - %04d", rand(100, 999), rand(100, 999), rand(100, 999));
    $address_id = rand(1, 999);

    return "INSERT INTO customer (customer_id, first_name, last_name, email, phone, address_id) VALUES ($id, '$first_name', '$last_name', '$email', '$phone', $address_id);";
}

function getProduct($products){
    $product_name = $products[array_rand($products)];
    $descriptions = ["Great for sitting", "Great for eating", "Family Friendly", "Storage"];
    $description = $descriptions[array_rand($descriptions)];
    $weight = rand(100, 500); 
    $base_cost = rand(100, 9999);

    return "INSERT INTO product (product_id, product_name, description, weight, base_cost) VALUES ($id, '$product_name', '$description', $weight, $base_cost);";
}

?>
