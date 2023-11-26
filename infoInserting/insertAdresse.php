<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Adresse</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <form action="infoInserting/insertAdresse.php" method="post" class="p-4 flex flex-col items-center">
        <label for="ville" class="mb-2 block">Ville:</label>
        <input type="text" id="ville" name="ville" class="w-full md:w-1/2 pb-2 border border-gray-300 rounded-md" required>

        <label for="quartier" class="mb-2 block">Quartier:</label>
        <input type="text" id="quartier" name="quartier" class="w-full md:w-1/2 pb-2 border border-gray-300 rounded-md" required>

        <label for="rue" class="mb-2 block">Rue:</label>
        <input type="text" id="rue" name="rue" class="w-full md:w-3/4 pb-2 border border-gray-300 rounded-md" required>

        <label for="code_postal" class="mb-2 block">Code postal:</label>
        <input type="text" id="code_postal" name="code_postal" class="w-full md:w-1/4 pb-2 border border-gray-300 rounded-md" required>

        <label for="email" class="mb-2 block">Email:</label>
        <input type="email" id="email" name="email" class="w-full md:w-3/4 pb-2 border border-gray-300 rounded-md" required>

        <label for="telephone" class="mb-2 block">Telephone:</label>
        <input type="tel" id="telephone" name="telephone" class="w-full md:w-1/4 pb-2 border border-gray-300 rounded-md" required>

        <input type="submit" value="Insert Adresse" class="mt-4 w-full md:w-1/4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
    </form>
</body>
</html>



<?php
include 'index.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ville = $_POST['ville'];
    $quartier = $_POST['quartier'];
    $rue = $_POST['rue'];
    $code_postal = $_POST['code_postal'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "cih_bank";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO adresse (ville, quartier, rue, code_postal, email, telephone) VALUES (?, ? , ? , ?, ?, ?)";
    $statement = $conn->prepare($sql);
    $statement->bind_param("sssssi", $ville, $quartier, $rue, $code_postal, $email, $telephone);

    if ($statement->execute() === TRUE) {
        echo "New adresse created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
