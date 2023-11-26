<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Account</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <form action="infoInserting/insertAccount.php" method="post" class="p-4 flex flex-col items-center">
        <label for="rib" class="mb-2 block">Rib:</label>
        <input type="text" id="rib" name="rib" class="w-full md:w-1/2 pb-2 border border-gray-300 rounded-md" required>

        <label for="devise" class="mb-2 block">Devise:</label>
        <input type="text" id="devise" name="devise" class="w-full md:w-1/2 pb-2 border border-gray-300 rounded-md" required>

        <label for="balance" class="mb-2 block">Balance:</label>
        <input type="number" id="balance" name="balance" class="w-full md:w-3/4 pb-2 border border-gray-300 rounded-md" required>

        <label for="user_id" class="mb-2 block">User_id:</label>
        <input type="number" id="user_id" name="user_id" class="w-full md:w-1/4 pb-2 border border-gray-300 rounded-md" required>

        <input type="submit" value="Insert Account" class="mt-4 w-full md:w-1/4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
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
