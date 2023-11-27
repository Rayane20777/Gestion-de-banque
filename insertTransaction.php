<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Transaction</title>
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
            <form action="insertTransaction.php" method="post" class="grid gap-4 grid-cols-2 border-b-4 border-gray-600 pb-4">
                <select name="type" id="type" class="pl-2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6" required>
                    <option value="credit">Credit</option>
                    <option value="debit">Debit</option>
                </select>


                <input type="number" id="amount" name="amount" placeholder="amount" class="pl-2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6" required>

                <input type="text" id="account_id" name="account_id" placeholder="account_id" class="pl-2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6" required>

                <input type="submit" value="Insert Transaction" class="bg-gray-600 text-white text-xl rounded">
            </form>
        </section>
</body>

</html>




<?php
include 'cnx.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['type'];
    $amount = $_POST['amount'];
    $account_id = $_POST['account_id'];

    

    $sql = "INSERT INTO transaction (type , amount, account_id) VALUES (?, ?, ?)";
    $statement = $conn->prepare($sql);
    $statement->bind_param("sdi", $type, $amount, $account_id);

    if ($statement->execute() === TRUE) {
        echo "New adresse created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}

$sql = "SELECT * FROM transaction";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr>";
    echo "<th>Id</th>";
    echo "<th>type</th>";
    echo "<th>amount</th>";
    echo "<th>account_id</th>";
    echo "</tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["type"] . "</td>";
        echo "<td>" . $row["amount"] . "</td>";
        echo "<td>" . $row["account_id"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No results found";
}
?>