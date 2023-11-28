<?php
session_start();
include('../cnx.php');

if (!isset($_SESSION['name']) || $_SESSION['user_type'] != 1) {
    header("Location: ../Login.php");
    exit();
}

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: ../Login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Welcome to Account</h1>
    <?php
    include('../cnx.php');

    if (!$conn) {
        die("La connexion a échoué : " . mysqli_connect_error());
    }

    // Requête pour récupérer la liste des comptes avec les informations de l'adresse
    $query = "SELECT user.usersnames as nom, user.passwords
              FROM user
              WHERE user.id = '$_SESSION[user_id]'";
    
    $result = mysqli_query($conn, $query);

    // Vérifier si la requête a réussi
    if ($result) {
        // Afficher la première table avec les informations de l'utilisateur
        echo "<h2>User Information</h2>
                <table border='1'>
                <thead>
                    <tr>
                        <th>usersnames</th>
                        <th>passwords</th>
                    </tr>
                </thead>
                <tbody>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['nom']}</td>
                    <td>{$row['passwords']}</td>
                  </tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "Erreur lors de l'exécution de la requête : " . mysqli_error($conn);
    }

    // Requête pour récupérer le reste des informations de l'adresse
    $queryAddress = "SELECT adresse.ville, adresse.quartier, adresse.rue, adresse.code_postal, adresse.email, adresse.telephone
                     FROM user
                     INNER JOIN adresse ON user.adresse_id = adresse.id
                     WHERE user.id = '$_SESSION[user_id]'";
    
    $resultAddress = mysqli_query($conn, $queryAddress);

    // Vérifier si la requête a réussi
    if ($resultAddress) {
        // Afficher la deuxième table avec le reste des informations de l'adresse
        echo "<h2>Address Information</h2>
                <table border='1'>
                <thead>
                    <tr>
                        <th>ville</th>
                        <th>quartier</th>
                        <th>rue</th>
                        <th>code_postal</th>
                        <th>email</th>
                        <th>telephone</th>
                    </tr>
                </thead>
                <tbody>";

        while ($rowAddress = mysqli_fetch_assoc($resultAddress)) {
            echo "<tr>
                    <td>{$rowAddress['ville']}</td>
                    <td>{$rowAddress['quartier']}</td>
                    <td>{$rowAddress['rue']}</td>
                    <td>{$rowAddress['code_postal']}</td>
                    <td>{$rowAddress['email']}</td>
                    <td>{$rowAddress['telephone']}</td>
                  </tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "Erreur lors de l'exécution de la requête : " . mysqli_error($conn);
    }

    // Requête pour récupérer le reste des informations de l'agence
    $queryAgence = "SELECT agence.longitude, agence.latitude, agence.adresse
                    FROM user
                    INNER JOIN agence ON user.agence_id = agence.id
                    WHERE user.id = '$_SESSION[user_id]'";
    
    $resultAgence = mysqli_query($conn, $queryAgence);

    // Vérifier si la requête a réussi
    if ($resultAgence) {
        // Afficher la troisième table avec le reste des informations de l'agence
        echo "<h2>Agence Information</h2>
                <table border='1'>
                <thead>
                    <tr>
                        <th>longitude</th>
                        <th>latitude</th>
                        <th>adresse</th>
                    </tr>
                </thead>
                <tbody>";

        while ($rowAgence = mysqli_fetch_assoc($resultAgence)) {
            echo "<tr>
                    <td>{$rowAgence['longitude']}</td>
                    <td>{$rowAgence['latitude']}</td>
                    <td>{$rowAgence['adresse']}</td>
                  </tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "Erreur lors de l'exécution de la requête : " . mysqli_error($conn);
    }

    $queryAgence = "SELECT agence.longitude, agence.latitude, agence.adresse
    FROM user
    INNER JOIN agence ON user.agence_id = agence.id
    WHERE user.id = '$_SESSION[user_id]'";

$resultAgence = mysqli_query($conn, $queryAgence);

// Vérifier si la requête a réussi
if ($resultAgence) {
// Afficher la troisième table avec le reste des informations de l'agence
echo "<h2>Agence Information</h2>
<table border='1'>
<thead>
    <tr>
        <th>longitude</th>
        <th>latitude</th>
        <th>adresse</th>
    </tr>
</thead>
<tbody>";

while ($rowAgence = mysqli_fetch_assoc($resultAgence)) {
echo "<tr>
    <td>{$rowAgence['longitude']}</td>
    <td>{$rowAgence['latitude']}</td>
    <td>{$rowAgence['adresse']}</td>
  </tr>";
}

echo "</tbody></table>";
} else {
echo "Erreur lors de l'exécution de la requête : " . mysqli_error($conn);
}
?>


</body>

</html>
