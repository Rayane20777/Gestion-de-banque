<!DOCTYPE html>
<html>
<head>
    <title>Insert Adresse</title>
</head>
<body>
    <form action="insertUser.php" method="post">
        <label for="usersname">username:</label>
        <input type="text" id="usersname" name="username" required>
        <br>

        <label for="password">password:</label>
        <input type="text" id="password" name="password" required>
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
    $usersname = $_POST['usersname'];
    $password = $_POST['password'];
    $adresse_id = $_POST['adresse_id'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "cih_bank";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO user (usersname, password, adresse_id) VALUES ('$usersname','$password' ,'$adresse_id')";

    if ($conn->query($sql) === TRUE) {
        echo "New user created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
