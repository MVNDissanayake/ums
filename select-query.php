<?php require_once('inc/connection.php'); ?>
<?php

    $query = "SELECT id, first_name, last_name, email FROM user";

    $result_set = mysqli_query($connection,$query);

    if($result_set) 
    {
        //cheaking how many  records returned from the query

        echo mysqli_num_rows($result_set) . " Records found. <hr>";

        /*$record = mysqli_fetch_assoc($result_set);
        echo "<pre>";
        print_r($record);
        echo "</pre>";
        */
        $table = '<table>';
        $table .= '<tr><th>ID</th><th> First Name </th><th> Last Name </th><th> Email </th></tr>';

       while ($record = mysqli_fetch_assoc($result_set))
       {

        $table .= '<tr>';
        $table .= '<td>' . $record['id'] . '</td>'; 
        $table .= '<td>' . $record['first_name'] . '</td>'; 
        $table .= '<td>' . $record['last_name'] . '</td>';
        $table .= '<td>' . $record['email'] . '</td>';
        $table .= '</tr>';

       }
       $table .= '</table>';

       
        // echo "Query Sucsessfull";

        //echo "Query Successfull";
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
    <style>
        table { border-collapse: collapse; }
        td,th { border: 1px solid black; padding: 20px; }
    </style>

    <?php echo $table?>

</body>
</html>

<?php mysqli_close($connection)?>