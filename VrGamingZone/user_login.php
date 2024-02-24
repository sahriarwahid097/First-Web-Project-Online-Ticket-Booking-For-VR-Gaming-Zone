<?php

$user = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'dbconnect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM user WHERE username='$username' and $password'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $count = mysqli_num_rows($result);
        if ($count > 0) {
          echo 'Login Suceesful'
          header('Location: user_page.php');
        } else{
          echo'invalid info'
        }
      }
?>