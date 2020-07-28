<?php
     session_start();
     $_SESSION["user_id_user"];
     $_SESSION["user_username"];

     unset($_SESSION["user_id_user"]);
     unset($_SESSION["user_username"]);

     session_unset();
     session_destroy();

     header("location:index.php");
?>