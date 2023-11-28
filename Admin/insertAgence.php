<?php
session_start();
include('../cnx.php');

if (!isset($_SESSION['name']) || $_SESSION['user_type'] != 2) {
    header("Location: ../Login.php");
    exit;
}

if (isset($_POST['logout'])) {
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
    header('Location: ../Login.php');
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Adresse</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>

<div class="min-h-full">
        <nav class="bg-gray-800">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="">

                <div class="hidden md:block">
                    <div class=" flex items-baseline space-x-4">
                    <a href="index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium" >Home</a>
                    <a href="insertBank.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Bank's</a>
                    <a href="insertAgence.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Agency's</a>
                    <a href="insertDistributeur.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Distrubuteur's</a>
                    <a href="insertRole.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Role's</a>
                    <a href="insertUser.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">User's</a>
                    <a href="insertAdresse.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Address's</a>
                    <a href="insertAccount.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Account's</a>
                    <a href="insertTransaction.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Transaction's</a>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </nav>


        <section id="add" class="mt-20 mx-auto max-w-7xl py-6 sm:px-6 lg:px-8 ">
    <form action="insertAgence.php" method="post" class="grid gap-4 grid-cols-2 border-b-4 border-gray-600 pb-4">
        <input type="text" id="longitude" name="longitude" placeholder="longitude" class="pl-2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6" required>

        <input type="text" id="latitude" name="latitude" placeholder="latitude" class="pl-2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6" required>

        <input type="text" id="adresse" name="adresse" placeholder="adresse" class="pl-2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6" required>

        <input type="text" id="bank_id" name="bank_id" placeholder="bank_id" class="pl-2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6" required>

        <input type="submit" name="insert" value="Insert User" class="bg-gray-600 text-white text-xl rounded">
    </form>
    </section>
</body>
</html>




<?php
include '../cnx.php';


if (isset($_POST['insert'])) {
    $longitude = $_POST['longitude'];
    $latitude = $_POST['latitude'];
    $adresse = $_POST['adresse'];
    $bank_id = $_POST['bank_id'];

   

    $sql = "INSERT INTO agence (longitude, latitude, adresse, bank_id) VALUES (?, ?, ?, ?)";
    $statement = $conn->prepare($sql);
    $statement->bind_param("ddsi", $longitude, $latitude, $adresse, $bank_id);

    if ($statement->execute() === TRUE) {
        echo "New adresse created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}

$sql = "SELECT * FROM agence";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div class='w-full overflow-hidden rounded-lg shadow p-4'>";
    echo "<table class='min-w-full text-left text-sm font-light'>";
    echo "<thead class='border-b font-medium dark:border-neutral-500'>";
    echo "<tr>";
    echo "<th scope='col' class='px-6 py-4'>ID</th>";
    echo "<th scope='col' class='px-6 py-4'>Longitude</th>";
    echo "<th scope='col' class='px-6 py-4'>Latitude</th>";
    echo "<th scope='col' class='px-6 py-4'>Address</th>";
    echo "<th scope='col' class='px-6 py-4'>Bank ID</th>";
    echo "<th scope='col' class='px-6 py-4'>Action</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody class='bg-white'>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td class='whitespace-nowrap px-6 py-4 font-medium'>" . $row["id"] . "</td>";
        echo "<td class='whitespace-nowrap px-6 py-4'>" . $row["longitude"] . "</td>";
        echo "<td class='whitespace-nowrap px-6 py-4'>" . $row["latitude"] . "</td>";
        echo "<td class='whitespace-nowrap px-6 py-4'>" . $row["adresse"] . "</td>";
        echo "<td class='whitespace-nowrap px-6 py-4'>" . $row["bank_id"] . "</td>";
        echo "<td class='whitespace-nowrap px-6 py-4'>";
        echo "<form method='post' action='edit.php'>";
        echo "<input type='hidden' name='edit_agence' value='" . $row['id'] . "'>";
        echo "<button type='submit' name='edit_btn' class='bg-blue-600 py-2 px-8 text-white font-bold'>Edit</button>";
        echo "</form>";
        echo "</td>";
        echo "<td class='whitespace-nowrap px-6 py-4'>";
        echo "<form method='post' action='insertAgence.php'>";
        echo "<input type='hidden' name='delete_id' value='" . $row['id'] . "'>";
        echo "<button type='submit' name='delete_btn' class='bg-red-600 py-2 px-8 text-white font-bold'>Delete</button>";
        echo "</form>";
        echo "</td>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
} else {
    echo "No results found";
}

// Handle deletion
if (isset($_POST['delete_btn'])) {
    $id = $_POST['delete_id'];

    // Delete the record from the 'user' table
    $deleteAgence = "DELETE FROM agence WHERE id = ?";
    $statement = $conn->prepare($deleteAgence);
    $statement->bind_param("i", $id);

    if ($statement->execute()) {
        echo "<p class='text-green-500 font-bold'>Agence with ID $id has been deleted</p>";
    } else {
        echo "<p class='text-red-500 font-bold'>Error deleting agence: " . $statement->error . "</p>";
    }

    $statement->close();
}

if (isset($_POST['update'])) {
    $id = $_POST['update_id'];
    $updatedLongitude = $_POST['updated_longitude'];
    $updatedLatitude = $_POST['updated_latitude'];
    $updatedAdresse = $_POST['updated_adresse'];
    $updatedBankId = $_POST['updated_bank_id'];

    // Update the agence record
    $updateAgence = "UPDATE agence SET longitude = ?, latitude = ?, adresse = ?, bank_id = ? WHERE id = ?";
    $statement = $conn->prepare($updateAgence);
    $statement->bind_param("ddssi", $updatedLongitude, $updatedLatitude, $updatedAdresse, $updatedBankId, $id);

    if ($statement->execute()) {
        echo "Agence with ID $id has been updated successfully";
    } else {
        echo "Error updating agence: " . $statement->error;
    }

    $statement->close();
}


?>
