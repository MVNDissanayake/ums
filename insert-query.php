<?php require_once('inc/connection.php'); ?>
<?php

    $first_name = 'Neranjan';
    $last_name = 'Dissanayke';
    $email = 'disanayakanuwan@gmail.com';
    $password = 'ndpassword';
    $is_deleted = 0;

    $hashed_password = sha1($password);
    // echo "hashed password : {$hashed_password}";

    $query = "INSERT INTO user(first_name, last_name, email, password, is_deleted) 
    VALUES('{$first_name}', '{$last_name}', '{$email}', '{$hashed_password}', {$is_deleted})";

    $result = mysqli_query($connection, $query);
    if($result)
    {
        echo "1 record added";
    }
    else
    {
        echo "Database query failed";
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
       
</body>
</html>

<?php mysqli_close($connection)?>