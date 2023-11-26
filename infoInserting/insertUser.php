<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert User</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <form action="infoInserting/insertUser.php" method="post" class="p-4 flex flex-col items-center">
        <label for="usersnames" class="mb-2 block">Username:</label>
        <input type="text" id="usersnames" name="usersnames" class="w-full md:w-1/2 pb-2 border border-gray-300 rounded-md" required>

        <label for="passwords" class="mb-2 block">Password:</label>
        <input type="password" id="passwords" name="passwords" class="w-full md:w-1/2 pb-2 border border-gray-300 rounded-md" required>

        <label for="adresse_id" class="mb-2 block">Address ID:</label>
        <input type="number" id="adresse_id" name="adresse_id" class="w-full md:w-3/4 pb-2 border border-gray-300 rounded-md" required>

        <input type="submit" value="Insert User" class="mt-4 w-full md:w-1/4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
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
