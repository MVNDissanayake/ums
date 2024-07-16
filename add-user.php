<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php require_once('inc/functions.php'); ?>
<?php

    $errors = array();
    $first_name = '';
    $last_name = '';
    $email = '';    
    $password = '';


    if (isset($_POST['submit'])) {

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];    
    $password = $_POST['password'];

        //checking required fields
        
        $req_fields = array('first_name', 'last_name', 'email', 'password');

        $errors = array_merge($errors, check_req_fields($req_fields));

        /*foreach ($req_fields as $field) {        
            if(empty(trim($_POST[$field]))) {
                $errors[] = $field . ' is required';
            }
        }*/
 
        // checking max Length

        $max_len_fields = array('first_name' =>50, 'last_name' =>100, 'email'=>100, 'password'=>40);

        $errors = array_merge($errors, check_max_len($max_len_fields));

        /* foreach ($max_len_fields as $field =>$max_len) {
            
            if(strlen(trim($_POST[$field])) > $max_len) {
                $errors[] = $field . 'must be less than' . $max_len . 'characters';
            }
        }*/
        
        //checking email address

        if(!is_email($_POST['email'])){
            $errors[] = 'Email address is inccorect';
        }

        // checking if email address already exists

        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $query = "SELECT *FROM user WHERE email ='{$email}' LIMIT 1";

        $result_set = mysqli_query($connection, $query);

        if($result_set){
            if(mysqli_num_rows($result_set) == 1){
                $errors[] =  'Email address already exists';
            }

        }

        if(empty($errors)){
            // No errors found..... adding new record
            $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
            $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
            $password = mysqli_real_escape_string($connection, $_POST['password']);
            // Email address already sanitized.....
            $hashed_password = sha1($password);

            $query = "INSERT INTO user ( ";
            $query .= "first_name, last_name, email, password, is_deleted";
            $query .= ") VALUES (";
            $query .= "'{$first_name}', '{$last_name}','{$email}','{$hashed_password}',0 ";
            $query .= ")";

            $result = mysqli_query($connection, $query);

            if($result){
                // query successful..... rederecting to users page 
                header('Location: users.php?user_added=true');
            } else {
                $errors[] = 'failed to add the new record.';
            }

        }

    }
        
    /*  if (empty(trim($_POST['first_name']))) {
            $errors[] = 'First Name is required';
        }
        if (empty(trim($_POST['last_name']))) {
            $errors[] = 'Last Name is required';
        }
        if (empty(trim($_POST['email']))) {
            $errors[] = 'Email is required';
        }
        if (empty(trim($_POST['password']))) {
            $errors[] = 'Password is required';
        } */
    

?>

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
        <?php

            if (!empty($errors)) {

                display_errors($errors);

            /*    echo '<div class=errmsg>';
                echo '<b>There were errors on your form.</b><br>';
                foreach ($errors as $error) {
                    echo $error.'<br>';
                }
                echo '</div>'; */

            }

        ?>
        <form action="add-user.php" method="post" class="userform">
            <p>
                <label for="">First Name: </label>
                <input type="text" name="first_name" <?php echo 'value="'. $first_name .'"'?>>

            </p>
            <p>
                <label for="">Last name: </label>
                <input type="text" name="last_name"<?php echo 'value="'. $last_name .'"'?>>
            </p>
            <p>
                <label for="">Email Address: </label>
                <input type="text" name="email" <?php echo 'value="'. $email .'"'?>>
            </p>
            <p>
                <label for="">New password: </label>
                <input type="password" name="password">
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