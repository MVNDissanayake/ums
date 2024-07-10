<?php

function verify_query($result_set){

    global $connection;

    if(!$result_set){
        die("Database quaery failed: " . mysqli_error($connection));
        
    }
}

?>