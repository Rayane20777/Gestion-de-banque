<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<link rel="stylesheet" href="style.css">

</head>
<body>
    <form action="login.php" method="post">
        <h2>Login</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <label for="">User name</label>
        <input type="text" name="uname" placeholder="User name">

        <label for="">Password</label>
        <input type="text" name="Password" placeholder="Password">

        <button type="submit">Login</button>
    </form>
</body>
</html>