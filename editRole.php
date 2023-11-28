<?php
include 'cnx.php';

if (isset($_POST['edit_btn'])) {
    $id = $_POST['edit_id'];

    // Fetch the role record based on the ID
    $selectRole = "SELECT * FROM role WHERE id = ?";
    $statement = $conn->prepare($selectRole);
    $statement->bind_param("i", $id);
    $statement->execute();
    $result = $statement->get_result();
    $role = $result->fetch_assoc();
    
    // Now you can display a form with the role details for editing
    echo "<form action='insertRole.php' method='post'>";
    echo "<input type='hidden' name='update_id' value='" . $role['id'] . "'>";
    echo "<input type='text' name='updated_name' value='" . $role['name'] . "' required>";
    echo "<input type='submit' name='update' value='Update'>";
    echo "</form>";

    $statement->close();
}
?>
