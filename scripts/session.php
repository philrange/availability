<?php
   session_start();
   
   $login_username = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query(connectToDb(),"select id, displayName, picture, admin from people where username = '$login_username' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_displayname = $row['displayName'];
   $login_picture = $row['picture'];
   $login_id = $row['id'];
   $admin_status = $row['admin'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:login.html");
   }
?>