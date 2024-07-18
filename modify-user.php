<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php require_once('inc/functions.php'); ?>
<?php

    $errors = array();
    $user_id = '';
    $first_name = '';
    $last_name = '';
    $email = '';    
    $password = '';

    if(isset($_GET['user_id'])) {
        // getting the user information
        $user_id = mysqli_real_escape_string($connection, $_GET['user_id']);
        $query = "SELECT * FROM user WHERE id = {$user_id} LIMIT 1";

        $result_set = mysqli_query($connection, $query);

        if($result_set)  {
            if(mysqli_num_rows($result_set)==1) {
                //user found
                $result = mysqli_fetch_assoc($result_set);
                $first_name = $result['first_name'];
                $last_name = $result['last_name'];
                $email = $result['email'];    
                

            } else {
                //user not found
                header('Location: users.php?=user_not_found');    
            }
        } else {
            // query unsuccesfull
            header('Location: users.php?=query_failed');
        }
    }


    if (isset($_POST['submit'])) {

    $user_id = $_POST['user_id'];    
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];    
    

        //checking required fields
        
        $req_fields = array('user_id', 'first_name', 'last_name', 'email',);

        $errors = array_merge($errors, check_req_fields($req_fields));

        /*foreach ($req_fields as $field) {        
            if(empty(trim($_POST[$field]))) {
                $errors[] = $field . ' is required';
            }
        }*/
 
        // checking max Length

        $max_len_fields = array('first_name' =>50, 'last_name' =>100, 'email'=>100,);

        $errors = array_merge($errors, check_max_len($max_len_fields));

        /* foreach ($max_len_fields as $field =>$max_len) {
            
            if(strlen(trim($_POST[$field])) > $max_len) {
                $errors[] = $field . 'must be less than' . $max_len . 'characters';
            }
        }*/
        
        //checking email address

        if(!is_email($_POST['email'])) {
            $errors[] = 'Email address is inccorect';
        }

        // checking if email address already exists

        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $query = "SELECT * FROM user WHERE email = '{$email}' AND id != {$user_id} LIMIT 1";

        $result_set = mysqli_query($connection, $query);

        if($result_set) {
            if(mysqli_num_rows($result_set) == 1){
                $errors[] =  'Email address already exists';
            }
        
        }

        if(empty($errors)) {
            // No errors found..... adding new record
            $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
            $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
            // Email address already sanitized.....

            $query = "UPDATE user SET ";
            $query .= "first_name = '{$first_name}', ";
            $query .= "last_name = '{$last_name}', ";
            $query .= "email = '{$email}' ";
            $query .= "WHERE id = '{$user_id}' LIMIT 1 ";

            $result = mysqli_query($connection, $query);

            if($result) {
                // query successful..... rederecting to users page 
                header('Location: users.php?user_modified=true');
            } else {
                $errors[] = 'failed to modified the record.';
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
    <title>View / modifiy User</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <header>
        <div class="appname">User managment System</div>
        <div class="loggedin">Welcome Username <?php echo $_SESSION['first_name']; ?><a href="logout.php">Log out</a></div>
    </header>
    <main>
        <h1><span>View / modifiy User<a href="users.php"> < Back to user list</a></span></h1>
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
        <form action="modify-user.php" method="post" class="userform">
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
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
                <label for="">password: </label>
                <span>********</span> | <a href="change-password.php?user_id=<?php echo $user_id;?>">Change Password</a>
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
