<!DOCTYPE html>
<html>
<head>
    <title>Insert Adresse</title>
</head>
<body>
    <form action="insertAdresse.php" method="post">
        <label for="ville">Ville:</label>
        <input type="text" id="ville" name="ville" required>
        <br>

        <label for="quartier">Quartier:</label>
        <input type="text" id="quartier" name="quartier" required>
        <br>

        <label for="rue">Rue:</label>
        <input type="text" id="rue" name="rue" required>
        <br>

        <label for="code_postal">Code postal:</label>
        <input type="text" id="code_postal" name="code_postal" required>
        <br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>

        <label for="telephone">Telephone:</label>
        <input type="tel" id="telephone" name="telephone" required>
        <br>

        <input type="submit" value="Insert Adresse">
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
