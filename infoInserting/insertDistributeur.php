<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Distributeur</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <form action="infoInserting/insertDistributeur.php" method="post" class="p-4 flex flex-col items-center">
        <label for="longitude" class="mb-2 block">Longitude:</label>
        <input type="text" id="longitude" name="longitude" class="w-full md:w-1/2 pb-2 border border-gray-300 rounded-md" required>

        <label for="latitude" class="mb-2 block">Latitude:</label>
        <input type="text" id="latitude" name="latitude" class="w-full md:w-1/2 pb-2 border border-gray-300 rounded-md" required>

        <label for="adresse" class="mb-2 block">Adresse:</label>
        <input type="text" id="adresse" name="adresse" class="w-full md:w-3/4 pb-2 border border-gray-300 rounded-md" required>

        <label for="agence_id" class="mb-2 block">Agence ID:</label>
        <input type="number" id="agence_id" name="agence_id" class="w-full md:w-1/4 pb-2 border border-gray-300 rounded-md" required>

        <input type="submit" value="Insert Distributeur" class="mt-4 w-full md:w-1/4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
    </form>
</body>
</html>




<?php
include 'index.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $longitude = $_POST['longitude'];
    $latitude = $_POST['latitude'];
    $adresse = $_POST['adresse'];
    $agence_id = $_POST['agence_id'];



    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "cih_bank";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO distributeur (longitude, latitude, adresse, agence_id) VALUES (?, ?, ?, ?)";
    $statement = $conn->prepare($sql);
    $statement->bind_param("ddsi", $longitude, $latitude, $adresse, $agence_id);

    if ($statement->execute() === TRUE) {
        echo "New adresse created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
