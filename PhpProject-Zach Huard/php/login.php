<?php 
    session_start();
    include_once "config.php"; //DATABASE CONNECTION
    $email = mysqli_real_escape_string($conn, $_POST['email']); //Takes user and pass data from input field
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    if(!empty($email) && !empty($password)){
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'"); //if fields arent empty, run query to db to search for email
        if(mysqli_num_rows($sql) > 0){ //if the query doesnt return an empty result
            $row = mysqli_fetch_assoc($sql); //continues going through rows
            $user_pass = md5($password); //unhashes password hash and assigns to variable
            $enc_pass = $row['password'];
            if($user_pass === $enc_pass){ //compares input password to db pass
                $status = "Active now";
                $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}"); //updates user to active status if login is succesful
                if($sql2){
                    $_SESSION['unique_id'] = $row['unique_id'];
                    echo "Refresh to continue";
                }else{
                    echo "Something went wrong. Please try again!";
                }
            }else{
                echo "Email or Password is Incorrect!";
            }
        }else{
            echo "$email - This email is not registered";
        }
    }else{
        echo "All input fields are required!";
    }
?>