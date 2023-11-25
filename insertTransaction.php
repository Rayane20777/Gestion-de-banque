<!DOCTYPE html>
<html>
<head>
    <title>Insert Adresse</title>
</head>
<body>
    <form action="insertTransaction.php" method="post">
        <label for="type">Type:</label>
        <select name="type" id="type">
            <option value="credit">credit</option>
            <option value="debit">debit</option>
        </select>
        <br>

        <label for="amount">Amount:</label>
        <input type="text" id="amount" name="amount" required>
        <br>

        <label for="account_id">Account_id:</label>
        <input type="text" id="account_id" name="account_id" required>
        <br>

        <input type="submit" value="Insert Adresse">
    </form>
</body>
</html>



<?php
include 'index.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['type'];
    $amount = $_POST['amount'];
    $account_id = $_POST['account_id'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "cih_bank";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO transaction (type , amount, account_id) VALUES (?, ?, ?)";
    $statement = $conn->prepare($sql);
    $statement->bind_param("sdi", $type, $amount, $account_id) ;

    if ($statement->execute() === TRUE) {
        echo "New adresse created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
