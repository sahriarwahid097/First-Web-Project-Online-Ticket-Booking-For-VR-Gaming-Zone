<?php

$user = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'dbconnect.php';
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM user WHERE username='$username'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $count = mysqli_num_rows($result);

        if ($count > 0) {
            $user = true; 
        } else {
            $sql = "INSERT INTO user (username, email, phone, password,domain_name)
                    VALUES ('$username', '$email', '$phone', '$password','crazeworld.com')";
            $result = mysqli_query($con, $sql);

            if ($result) {
                echo 'Success';
                header('Location: index.php');
            } else {
                header('Location: register_page.php');
                die();
            }
        }
    } else {
        die(mysqli_error($con));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-image: url(./assets/img/lsr2.png);
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }

    form {
     
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 400px;
      border: 0.5px solid skyblue;
      text-align: center;
    }
    h2 {
      margin-top: 0;
      color: white;
    }

    label {
      display: block;
      margin-bottom: 8px;
      text-align: left;
      color: white;
    }

    input {
      background-color: transparent;
      color: white;
      width: 100%;
      padding: 15px;
      border: none;
      outline: none;
      border: 1px solid pink;
      margin-bottom: 12px;
      box-sizing: border-box;
      border-radius: 40px;
    }

    button {
      background-color: blue;
      color: #fff;
      padding: 15px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      width: 100%;
      margin-top: 30px;
      transition: background-color 0.3s;

    }

    button:hover {
      background-color: #5a9ed6;
    }
  </style>
</head>
<body>

  <?php
  if ($user) {
    echo '<script>alert("Username already exists. Please choose a different username.");</script>';
  }
  ?>
  <form action=register_page.php method="post">
    <h2>Registration Form</h2>
    <label for="username">Userame:</label>
    <input type="text" id="username" name="username" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="phone">Phone Number:</label>
    <input type="tel" id="phone" name="phone" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">Register</button>
  </form>
</body>
</html>
