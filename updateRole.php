<?php
include 'cnx.php';

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
