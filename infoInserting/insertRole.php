<!DOCTYPE html>
<html>
<head>
    <title>Insert Role</title>
</head>
<body>
    <form action="insertRole.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <input type="submit" value="Insert Role">
    </form>
</body>
</html>



<?php
include 'index.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "cih_bank";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO role (name) VALUES (?)";
    $statement = $conn->prepare($sql);
    $statement->bind_param("s", $name);

    if ($statement->execute() === TRUE) {
        echo "New role created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
