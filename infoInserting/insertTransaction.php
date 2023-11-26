<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Transaction</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <form action="infoInserting/insertTransaction.php" method="post" class="p-4 flex flex-col items-center">
        <label for="type" class="mb-2 block">Type:</label>
        <select name="type" id="type" class="w-full md:w-1/2 pb-2 border border-gray-300 rounded-md" required>
            <option value="credit">Credit</option>
            <option value="debit">Debit</option>
        </select>

        <label for="amount" class="mb-2 block">Amount:</label>
        <input type="number" id="amount" name="amount" class="w-full md:w-1/2 pb-2 border border-gray-300 rounded-md" required>

        <label for="account_id" class="mb-2 block">Account ID:</label>
        <input type="text" id="account_id" name="account_id" class="w-full md:w-3/4 pb-2 border border-gray-300 rounded-md" required>

        <input type="submit" value="Insert Transaction" class="mt-4 w-full md:w-1/4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
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
