<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php

    //cheaking if a user is logged in
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <header>
        <div class="appname">User managment System</div>
        <div class="loggedin">Welcome Username<?php echo $_SESSION['first_name']; ?><a href="logout.php">Log out</a></div>
    </header>
    <h1>Users</h1>
</body>
</html>