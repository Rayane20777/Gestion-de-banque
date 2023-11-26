<!DOCTYPE html>
<html>
<head>
    <title>Insert Adresse</title>
</head>
<body>
    <form action="insertAccount.php" method="post">
        <label for="rib">Rib:</label>
        <input type="text" id="rib" name="rib" required>
        <br>

        <label for="devise">Devise:</label>
        <input type="text" id="devise" name="devise" required>
        <br>

        <label for="balance">Balance:</label>
        <input type="text" id="balance" name="balance" required>
        <br>

        <label for="user_id">User_id:</label>
        <input type="text" id="user_id" name="user_id" required>
        <br>

        <input type="submit" value="Insert Adresse">
    </form>
</body>
</html>



<?php
include 'index.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rib = $_POST['rib'];
    $devise = $_POST['devise'];
    $balance = $_POST['balance'];
    $user_id = $_POST['user_id'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "cih_bank";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO account (rib, devise, balance, user_id) VALUES (?, ? , ? , ?)";
    $statement = $conn->prepare($sql);
    $statement->bind_param("ssdi", $rib, $devise, $balance, $user_id);
    

    if ($statement->execute() === TRUE) {
        echo "New adresse created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
