<?php
 

if($_SERVER["REQUEST_METHOD"] == "POST") {
   if ($_POST["formname"] == "login") {
      $error = login();
   } else {
      $error = register();
   }
}

function login() {

   session_start();
   
      $db = connectToDb();
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT username, password FROM people WHERE username = '$myusername'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $hashedPassword = $row['password'];
      
      $count = mysqli_num_rows($result);

      mysqli_close($db);
      
      if($count == 1 && password_verify($mypassword, $hashedPassword)) {
         $_SESSION['login_user'] = $myusername;
         
         header("location: ../main.html");
         return "";
      } else {
         return "Your Login Name or Password is invalid";
      }
}

function register() {
      $db = connectToDb();
      $myusername = mysqli_real_escape_string($db,$_POST['username']);

      $userExists = doesUserExist($db, $myusername);

      if ($userExists) {
         return "User with this name already exists.";
      } else {
         return createUser($db, $myusername);
      }
}

function createUser($db, $username) {

   $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
   $hashedPassword = password_hash($mypassword, PASSWORD_BCRYPT);
   $mydisplayname = mysqli_real_escape_string($db,$_POST['display_name']); 

   $sql = "insert into people (username, displayName, password, picture) values ('" . $username . "', 
   '" . $mydisplayname . "', '" . $hashedPassword . "', 'images/default.png')";

   $result = mysqli_query($db, $sql);

   if ($result) {
      return "User " . $username . " created.";
   } else {
      echo "Error creating user: " . mysqli_error($db);
   }

   mysqli_close($db);
   
}

   function doesUserExist($db, $myusername) {
      $sql = "SELECT username FROM people WHERE username = '$myusername'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $count = mysqli_num_rows($result);
      if($count == 0 ) {
         return false;
      } else {
         return true;
      }
   }

?>