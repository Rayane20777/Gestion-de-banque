<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Role</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <form action="infoInserting/insertBank.php" method="post" class="p-4 flex flex-col items-center">
        <label for="name" class="mb-2 block">Name:</label>
        <input type="text" id="name" name="name" class="w-full md:w-1/2 pb-2 border border-gray-300 rounded-md" required>

        <label for="bank_logo" class="mb-2 block">Bank logo URL:</label>
        <input type="text" id="bank_logo" name="bank_logo" class="w-full md:w-3/4 pb-2 border border-gray-300 rounded-md" required>

        <input type="submit" value="Insert Bank" class="mt-4 w-full md:w-1/4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
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
