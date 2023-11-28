<?php

    session_start();
    include('../cnx.php');

    if (!$_SESSION['name'] || $_SESSION['user_type'] != 1) {
        header("Location: ../Login.php");
        exit();
    }


    if (isset($_GET['rm'])) {
        $id_to_remove = $_GET['rm'];

        $run_delete = "DELETE FROM account WHERE id = $id_to_remove";
        $run_delete = mysqli_query($cnx, $run_delete);
        echo "<script>window.alert('Account Deleted Succesfully');</script>";
        header("Location: Data.php");
    }

    if (isset($_POST['logout'])) {
        session_unset();
        session_destroy();
        header('Location: ../Login.php');
        exit();
    }

?>



