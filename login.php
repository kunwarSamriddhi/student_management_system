<?php 
    session_start();
    // print_r($_SESSION);
    include 'templates/head.php';
    // require_once 'config/db.php';
?>


<div class="login-page">
    <?php
        include 'templates/login.php';
    ?>
</div>