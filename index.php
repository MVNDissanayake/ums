<?php require_once('inc/connection.php'); ?>
<?php

//cheack for form submitions
if (isset($_POST['submit'])) {

        $error  = array();

        //cheak if the username ans passwored has been entered
        if(!isset($_POST['email']) || strlen(trim($_POST['email'])) < 1 ) {

            $errors[] = 'username is missing / invalied';

        }

        if(!isset($_POST['password']) || strlen(trim($_POST['email'])) < 1 ) {

            $errors[] = 'Password is missing / invalied';

        }


        //cheack if there are erros in the form
        if(empty($errors)) {   
             
            //save username and the password into variaables
            $email = mysqli_real_escape_string($connection,$_POST['email']);
            $password = mysqli_real_escape_string($connection,$_POST['password']);
            $hashed_password = sha1($password);
     
            //prepare database query
            $query = "SELECT *FROM user
                WHERE email = '{$email}'
                AND password = '{$hashed_password}'
                LIMIT 1 ";

            $result_set = mysqli_query($connection, $query);
        
            if($result_set) {
                // query Sucssesfull
        
                if(mysqli_num_rows($result_set) == 1) {
                        //valied user found
                        //rederect to user.php
                        header('location: users.php');
                    } else {
                        // Name and password invalied
                        $errors[] = 'invalied Username / password';
                    }

            } else {

                $errors[] = 'Database Quary failed';
        }
    }       
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css"> 
</head>
<body>
    <div class="login">

    <form action ="index.php" method = "post">
        
        <fieldset>
            <legend><h1>Log in</h1></legend>
            
               
                <?php
                if (isset($errors) && !empty($errors)){

                    echo '<p class="error"> Invalid Username / Password </p>';
                }
                ?>

                <p>
                    <label for="">Username:</lebel>
                    <input type="text" name="email" id="" placeholder="email Address">
                </p>

                <p>
                    <label for="">Password:</lebel>
                    <input type="password" name="password" id="" placeholder="password">
                </p>

                <p>
                    <button type="submit" name="submit">Log In</button>
                </p>

        </fieldset>
    </form>
    </div>
</body>
</html>

<?php mysqli_close($connection)?>