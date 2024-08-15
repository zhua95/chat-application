
<?php
//Connection to chatdb database
  $hostname = "localhost";
  $username = "test";
  $password = "password";
  $dbname = "chatdb";

  $conn = mysqli_connect($hostname, $username, $password, $dbname);
  if(!$conn){
    echo "Database connection error".mysqli_connect_error();
  }
?>
