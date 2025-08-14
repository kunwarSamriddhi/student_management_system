<?php
    session_start();
    require_once ('../config/db.php');

    $errors = [];
    $result = '';

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $email= filter_input(INPUT_POST,'email',FILTER_SANITIZE_STRING);
        $password= filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);

        // email validation
        if(empty($email)){
            $errors[] = "Email is required";
        }
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors[]="Please enter a valid email address";
        }
        
        // password validation
        if(empty($password)){
            $errors[]="Password is required";
        }
        elseif(strlen($password)<6){
            $errors[]="Password must be atleast 6 characters";
        }

    }

    if(empty($errors)){
        $query= "SELECT name,password, email FROM users WHERE email = '$email'";

        $result = mysqli_query($conn,$query);

        if(mysqli_num_rows($result)>0){
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password,$row['password'])){
                $_SESSION['name']=$row['name'];
                header('Location:../index.php');
                exit();
            }else{
                $errors[]='Invalid password';
            }
        }
    }else{
        $errors[]='Email not found.Please sign up.';
    }

    $_SESSION['errors']=$errors;
    header("Location:../login.php");
    exit();

?>
