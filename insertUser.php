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

                <input type="submit" value="Insert User" class="bg-gray-600 text-white text-xl rounded">
            </form>
        </section>
</body>

</html>




<?php
include 'cnx.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usersnames = $_POST['usersnames'];
    $passwords = $_POST['passwords'];
    $adresse_id = $_POST['adresse_id'];

    $sql = "INSERT INTO user (usersnames, passwords, adresse_id) VALUES (?,?,?)";
    $statement = $conn->prepare($sql);
    $statement->bind_param("ssi", $usersnames, $passwords, $adresse_id);
    if ($statement->execute() === TRUE) {
        echo "New user hAs benn added";
    } else {
        echo "Error" . $sql . $conn->error;
    }
}

$sql = "SELECT * FROM user";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div class='w-full overflow-hidden rounded-lg shadow p-4'>";
    echo "<table class='min-w-full text-left text-sm font-light'>";
    echo "<thead class='border-b font-medium dark:border-neutral-500'>";
    echo "<tr>";
    echo "<th scope='col' class='px-6 py-4'>#</th>";
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
        echo "<td class='whitespace-nowrap px-6 py-4'>Admin</td>";
        echo "<td class='whitespace-nowrap px-6 py-4'>";
        echo "<button class='bg-blue-600 py-2 px-8 text-white font-bold'>Edit</button>";
        echo "<button class='bg-red-600 py-2 px-8 text-white font-bold'>Delete</button>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
} else {
    echo "No results found";
}





?>