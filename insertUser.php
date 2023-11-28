<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert User</title>
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
                                <a href="index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Home</a>
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
            <form action="insertUser.php" method="post" class="grid gap-4 grid-cols-2 border-b-4 border-gray-600 pb-4">

                <input type="text" id="usersnames" name="usersnames" placeholder="User Name" class="pl-2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6" required>

                <input type="password" id="passwords" name="passwords" placeholder="User password" class="pl-2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400  sm:text-sm sm:leading-6" required>

                <input type="number" id="adresse_id" name="adresse_id" placeholder="Id-Adresse" class="pl-2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400  sm:text-sm sm:leading-6" required>

                <input type="submit" name="insert" value="Insert User" class="bg-gray-600 text-white text-xl rounded">
            </form>
        </section>
</body>

</html>







<?php
include 'cnx.php';

if (isset($_POST['insert'])) {
    $usersnames = isset($_POST['usersnames']) ? $_POST['usersnames'] : null;
    $passwords = isset($_POST['passwords']) ? $_POST['passwords'] : null;
    $adresse_id = isset($_POST['adresse_id']) ? $_POST['adresse_id'] : null;

    $sql = "INSERT INTO user (usersnames, passwords, adresse_id) VALUES (?,?,?)";
    $statement = $conn->prepare($sql);

    if ($statement) {
        $statement->bind_param("ssi", $usersnames, $passwords, $adresse_id);
        if ($statement->execute() === TRUE) {
            echo "<p class='text-blue-500 font-bold'>New user has been added</p>";
        } else {
            echo "<p class='text-red-500 font-bold'>Error: " . $sql . $conn->error . "</p>";
        }

    } else {
        echo "<p class='text-red-500 font-bold'>Error preparing statement</p>";
    }
}

$sql = "SELECT * FROM user";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div class='w-full overflow-hidden rounded-lg shadow p-4'>";
    echo "<table class='table min-w-full text-left text-sm font-light'>";
    echo "<thead class='border-b font-medium dark:border-neutral-500'>";
    echo "<tr>";
    echo "<th scope='col' class='px-6 py-4'>Id</th>";
    echo "<th scope='col' class='px-6 py-4'>UserName</th>";
    echo "<th scope='col' class='px-6 py-4'>Password</th>";
    echo "<th scope='col' class='px-6 py-4'>Address Id</th>";
    echo "<th scope='col' class='px-6 py-4'>Role</th>";
    echo "<th scope='col' class='px-6 py-4'>Action</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody class='bg-white'>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td class='whitespace-nowrap px-6 py-4 font-medium'>" . $row["id"] . "</td>";
        echo "<td class='whitespace-nowrap px-6 py-4'>" . $row["usersnames"] . "</td>";
        echo "<td class='whitespace-nowrap px-6 py-4'>" . $row["passwords"] . "</td>";
        echo "<td class='whitespace-nowrap px-6 py-4'>" . $row["adresse_id"] . "</td>";
        echo "<td class='whitespace-nowrap px-6 py-4'>";
        echo "<form method='post' action='editRole.php'>";
        echo "<input type='hidden' name='edit_id' value='" . $row['id'] . "'>";
        echo "<button type='submit' name='edit_btn' class='bg-blue-600 py-2 px-8 text-white font-bold'>Edit</button>";
        echo "</form>";
        echo "</td>";
        echo "<form method='post' action='insertUser.php'>";
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
    echo "<p class='text-gray-500'>No results found</p>";
}

// Handle deletion
if (isset($_POST['delete_btn'])) {
    $id = $_POST['delete_id'];

    // Delete the record from the 'user' table
    $deleteUser = "DELETE FROM user WHERE id = ?";
    $statement = $conn->prepare($deleteUser);
    $statement->bind_param("i", $id);

    if ($statement->execute()) {
        echo "<p class='text-green-500 font-bold'>User with ID $id has been deleted</p>";
    } else {
        echo "<p class='text-red-500 font-bold'>Error deleting user: " . $statement->error . "</p>";
    }

}

if (isset($_POST['update'])) {
    $id = $_POST['update_id'];
    $updatedName = $_POST['updated_name'];

    // Update the role record
    $updateRole = "UPDATE role SET name = ? WHERE id = ?";
    $statement = $conn->prepare($updateRole);
    $statement->bind_param("si", $updatedName, $id);

    if ($statement->execute()) {
        echo "Role with ID $id has been updated successfully";
    } else {
        echo "Error updating role: " . $statement->error;
    }

    $statement->close();
}

?>
