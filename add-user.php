<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php require_once('inc/functions.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <header>
        <div class="appname">User managment System</div>
        <div class="loggedin">Welcome Username <?php echo $_SESSION['first_name']; ?><a href="logout.php">Log out</a></div>
    </header>
    <main>
        <h1>Add New User<span><a href="users.php"> < Back to user list</a></span></h1>

        <form action="add-user.php" method="post" class="userform">
            <p>
                <label for="">First Name: </label>
                <input type="text" name="first_name" required>

            </p>
            <p>
                <label for="">Last name: </label>
                <input type="text" name="last_name" required>
            </p>
            <p>
                <label for="">Email Address: </label>
                <input type="email" name="email" required>
            </p>
            <p>
                <label for="">New password: </label>
                <input type="password" name="password" required>
            </p>
            <p>
                <label for="">&nbsp;</label>
                <button type="submit" name="submit">Save</button>
            </p>
        </form>

    </form>
    </main>
</body>

</html>