<?php
    require_once ('../config/db.php');
    session_start();

    $errors = [];
    // $result = '';

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $name= filter_input(INPUT_POST,'name',FILTER_SANITIZE_STRING);
    //    print_r($name);
        $email= filter_input(INPUT_POST,'email',FILTER_SANITIZE_STRING);
        // print_r($email);
        $password= filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);
        $c_password= filter_input(INPUT_POST,'c_password',FILTER_SANITIZE_STRING);

    // name validation
        if(empty($name)){
            $errors[] = "Name is required";
        }
        elseif(strlen($name)<3){
            $errors[]="Name must be atleast 3 character long";
        }

        // email validation
        if(empty($email)){
            $errors[] = "Email is required";
        }
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors[]="Please enter a valid email address";
        }

        if(empty($password)){
            $errors[]="Password is required";
        }
        elseif(strlen($password)<6){
            $errors[]="Password must be atleast 6 characters";
        }

        if(empty($c_password)){
            $errors[]="Password is required";
        }
        elseif($c_password !== $password){
            $errors[]="Passwords don't match";
        }
    }
    /* if(!empty($errors)){
        $_SESSION['errors']=$errors;
        header("Location:../signup.php");
        exit();
    } */

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form data</title>
</head>
<body>
    <h1>Form Submitted Data</h1>
    <?php
    if(!empty($errors)):?>
    <div style="color:red;">
        <h2>Error:</h2>
        <ul>
            <?php foreach($errors as $error):?>
                <li><?php echo htmlspecialchars($error);?></li>
                <?php endforeach; ?>
        </ul>
    </div>

    <?php endif; ?>
</body>
</html>

<!-- 
 $query = "INSERT INTO users(name,email,dob,bio,country,suscribe) VALUE('$name','$email','$password','$c_password')";

    if(mysqli_query($conn,$query)){
        $result = "Data inserted successfully";
        $_SESSION['result'] =$result;
        unset($_SESSION['errors']);

    } else{
        $errors[]= "Error inserting data: ".mysqli_error($conn);
        $_SESSION['errors']=$errors;
    }
    header('Location:../templates/register.php');
    exit();
 -->