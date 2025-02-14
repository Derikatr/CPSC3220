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
$getdomains = fopen("domains.txt","r") or die ("Cannot find file");
$getLastNames = fopen("last_names.txt","r") or die ("Cannot find file");
$lastNames = file("last_names.txt", FILE_IGNORE_NEW_LINES);	
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
			
$parts = explode(".", $email); // Disects the domains from TLDs
$validTLDs = ["com", "edu"]; // List of valid TLDs

//Loop that takes from the domains array and combines with valid TLDs
for ($i = 0; $i < count($parts) - 1; $i++) {
    if (in_array($parts[$i + 1], $validTLDs)) {
        $domains[] = $parts[$i] . "." . $parts[$i + 1]; // Combine valid domain
    }
}

//Work through and randomize name, domains, addresses for 25 UNIQUE People
for ($i = 0; $i < 25; $i++){
	$lastName = $lastNames[array_rand($lastNames)];
	$domain = $domains[array_rand($domains)]; 
	
//Print array
echo "<tr>
		<td>placeHolder</td>
		<td>$lastName</td>
		<td>placeHolder</td>
        <td>$domain</td>
    </tr>";
}

?>