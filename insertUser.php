<!DOCTYPE html>
<html>
<head>
    <title>Insert Adresse</title>
</head>
<body>
    <form action="insertUser.php" method="post">
        <label for="usersnames">usersnames:</label>
        <input type="text" id="usersnames" name="usersnames" required>
        <br>

        <label for="passwords">passwords:</label>
        <input type="text" id="passwords" name="passwords" required>
        <br>

        <label for="adresse_id">adress_id:</label>
        <input type="text" id="adresse_id" name="adresse_id" required>
        <br>

        <input type="submit" value="Insert Adresse">
    </form>
</body>
</html>



<?php
include 'index.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usersnames = $_POST['usersnames'];
    $passwords = $_POST['passwords'];
    $adresse_id = $_POST['adresse_id'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "cih_bank";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO user (usersnames , passwords, adresse_id) VALUES (?, ?, ?)";
    $statement = $conn->prepare($sql);
    $statement->bind_param("ssi", $usersnames, $passwords, $adresse_id) ;

    if ($statement->execute() === TRUE) {
        echo "New user created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
