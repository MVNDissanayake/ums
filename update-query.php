<?php require_once('inc/connection.php'); ?>
<?php

$query = "UPDATE user SET first_name = 'Isuru' WHERE id = 1 LIMIT 1";
$result_set = mysqli_query($connection,$query);

// mysqli_affected_rows() = return of rows affected1

if($result_set)
{
    echo mysqli_affected_rows($connection) . "Records Updated";
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
    <title>Update Query</title>
</head>
<body>
    
</body>
</html>

<?php mysqli_close($connection)?>