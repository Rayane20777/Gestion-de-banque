<!DOCTYPE html>
<html>
<head>
    <title>Insert Role</title>
</head>
<body>
    <form action="insertBank.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br>

        <label for="bank_logo">bank_logo:</label>
        <input type="text" id="bank_logo" name="bank_logo" required>
        <br>

        <input type="submit" value="Insert Role">
    </form>
</body>
</html>



<?php
include 'index.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $bank_logo = $_POST['bank_logo'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "cih_bank";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO bank (name, bank_logo) VALUES (?, ?)";
    $statement = $conn->prepare($sql);
    $statement->bind_param("ss", $name, $bank_logo);

    if ($statement->execute() === TRUE) {
        echo "New role created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
