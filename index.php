<?php
session_start();
    include 'function/helper.php';
    if(!is_logged_in()){
        header("Location: ./login.php");
        exit();
    }

    if(is_user()){
        render_default_template('student/dashboard.php');
        // header("Location: student/dashboard.php");
        exit();
    } elseif(is_admin()){
         render_default_template('admin/dashboard.php');
        // header("Location: admin/dashboard.php");
        exit();
    }
    
?>