<!DOCTYPE html>
<html>
<head>
    <title>Insert Adresse</title>
</head>
<body>
    <form action="insertDistributeur.php" method="post">
        <label for="longitude">Longitude:</label>
        <input type="text" id="longitude" name="longitude" required>
        <br>

        <label for="latitude">Latitude:</label>
        <input type="text" id="latitude" name="latitude" required>
        <br>

        <label for="adresse">Adresse:</label>
        <input type="text" id="adresse" name="adresse" required>
        <br>

        <label for="agence_id">Agence_id:</label>
        <input type="text" id="agence_id" name="agence_id" required>
        <br>

        <input type="submit" value="Insert Adresse">
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
