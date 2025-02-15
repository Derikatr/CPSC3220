<!DOCTYPE html>
<html lang="en">
<!-- Generates Table -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Processing</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 8px;
            text-align: center;
        }
    </style>
</head>
<body>

<?php

//File handeling
$streetNames = file("street_names.txt", FILE_IGNORE_NEW_LINES);
$streetTypes = file("street_types.txt", FILE_IGNORE_NEW_LINES);
$getdomains = fopen("domains.txt","r") or die ("Cannot find file");
$getLastNames = fopen("last_names.txt","r") or die ("Cannot find file");
$lastNames = file("last_names.txt", FILE_IGNORE_NEW_LINES);	
$firstNames = file("first_names.csv", FILE_IGNORE_NEW_LINES);
$email = fgets($getdomains);
fclose($getdomains);
fclose($getLastNames);

echo "<table>
            <tr>
                <th>First Name </th>
                <th>Last name </th>
                <th>Address </th>
                <th>Email </th>
            </tr>";

//name generator
function UniqueNames($used_names = [] , $firstNames, $lastNames){

do{
    $firstName= $firstNames[array_rand($firstNames)];//random first name generator
    $lastName= $lastNames[array_rand($lastNames)];//random last name generator
}
//search for used names from names
while(in_array($firstName,$lastName, $used_names));
$used_names[] = $firstName. '' . $lastName;//stores full name
return [$firstName, $lastName];
}

$used_name = [];

$parts = explode(".", $email); // Disects the domains from TLDs
$validTLDs = ["com", "edu"]; // List of valid TLDs
$domains = [];

//Loop that takes from the domains array and combines with valid TLDs
for ($i = 0; $i < count($parts) - 1; $i++) {
    if (in_array($parts[$i + 1], $validTLDs)) {
        $domains[] = $parts[$i] . "." . $parts[$i + 1]; // Combine valid domain
    }
}

$usedAddresses = [];

// generating unique addresses
function generateUniqueAddress(&$usedAddresses, $streetNames, $streetTypes) {
    do {
        $streetNum = rand(1, 9999);
        $streetName = $streetNames[array_rand($streetNames)];
        $streetType = $streetTypes[array_rand($streetTypes)];
        $address = "$streetNum $streetName $streetType";
    } while (in_array($address, $usedAddresses)); // Ensure uniqueness

    $usedAddresses[] = $address; // Add to used list
    return $address;
}


//Work through and randomize name, domains, addresses for 25 UNIQUE People
for ($i = 0; $i < 25; $i++){
	$firstName = $firstNames[array_rand($firstNames)];
    $lastName = $lastNames[array_rand($lastNames)];
	$domain = $domains[array_rand($domains)]; 
	$address = generateUniqueAddress($usedAddresses, $streetNames, $streetTypes);

	
//Print array
echo "<tr>
		<td>$firstName</td> // Place holder for First names
		<td>$lastName</td>
		<td>$address</td> 
        <td>$domain</td>
    </tr>";
}

?>

</body>
</html>

