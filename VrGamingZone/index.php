<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'dbconnect.php';

    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $admin_sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";

    $result = mysqli_query($con, $user_sql);
    if ($result) {
        $count = mysqli_num_rows($result);
        if ($count > 0) {
            $user_data = mysqli_fetch_assoc($result);
            $_SESSION['user_id'] = $user_data['user_id'];
            $_SESSION['user_name'] = $user_data['Username'];
            header('Location: user_page.php');
            exit();
        }
    }

    $admin_result = mysqli_query($con, $admin_sql);
    if ($admin_result) {
        $admin_count = mysqli_num_rows($admin_result);
        if ($admin_count > 0) {
            $admin_data = mysqli_fetch_assoc($admin_result);
            $_SESSION['admin_id'] = $admin_data['admin_id'];
            $_SESSION['admin_name'] = $admin_data['username'];
            header('Location: admin_page.php');
            exit();
        }
    }

    $_SESSION['login_error'] = true;
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
      }

      .container {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url(./assets/img/bg.png);
        background-position: center;
        background-size: cover;
        padding-left: 8px;
        padding-right: 8px;
        box-sizing: border-box;
      }

      .logo {
        position: absolute;
        top: 10px;
        left: 20px;
        animation: rotateLogo 5s linear infinite;
      }

      @keyframes rotateLogo {
        0% {
          transform: rotate(0deg);
        }
        50% {
          transform: rotate(180deg);
        }
      }

      .login_box {
        width: 420px;
        background: transparent;
        color: #fff;
        border-radius: 10px;
        border: 0.5px solid white;
        padding: 30px 40px;
        margin-right: 250px;
      }

      .login_box h1 {
        font-size: 36px;
        text-align: center;
      }

      .login_box .input_box {
        width: 100%;
        height: 50px;
        position: relative;
        margin: 30px 0;
      }

      .input_box input {
        width: 100%;
        height: 100%;
        color: white;
        border: none;
        outline: none;
        border: 2px solid #fff;
        border-radius: 40px;
        font-size: 16px;
        padding: 20px 45px 20px 20px;
        background: transparent;
      }

      .input_box input::placeholder {
        color: white;
      }

      .login_box .rem-for {
        display: flex;
        justify-content: space-around;
        font-size: 14.5px;
        margin: -15px 0 15px;
      }

      .rem-for label input {
        accent-color: #fff;
        margin-right: 3px;
      }

      .rem-for a {
        color: #fff;
      }

      .login_box .btn {
        width: 100%;
        height: 45px;
        background: transparent;
        border-radius: 40px;
        border-color: black;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        font-size: 20px;
        color: #fff;
        font-weight: 600;
      }

      .login_box .btn:hover {
        background: #000;
        color: #fff;
      }

      .reg-link {
        font-size: 14.5px;
        text-align: center;
        margin-top: 20px;
      }

      .reg-link p a {
        color: #fff;
        font-weight: 600;
      }

      .card {
        position: relative;
      }

      .card-content {
        position: absolute;
        top: -5%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        text-shadow: 1px 1px 2px rgba(235, 7, 147, 0.8);
        display: none;
        white-space: nowrap;
      }

      .card:hover .card-content {
        display: block;
      }

      .card {
        width: 120px;
        height: 150px;
        display: inline-block;
        border-radius: 10px;
        padding: 15px 25px;
        box-sizing: border-box;
        cursor: pointer;
        margin: 10px 15px;
        background-position: center;
        background-size: cover;
        text-align: right;
        transition: transform 0.3s ease-in-out;
      }

      .card:hover {
        transform: translateY(-15px);
      }

      .card1 {
        background-image: url(./assets/img/card3.png);
        position: absolute;
        bottom: 250px;
        right: 200px;
      }

      .card2 {
        background-image: url(./assets/img/card222.jpg);
        position: absolute;
        bottom: 250px;
        right: 20px;
      }

      .card3 {
        background-image: url(./assets/img/card44.png);
        position: absolute;
        bottom: 50px;
        right: 200px;
      }

      .card4 {
        background-image: url(./assets/img/card333.png);
        position: absolute;
        bottom: 50px;
        right: 20px;
      }

      .text-top-left {
        position: absolute;
        top: 10px;
        left: 70px;
        color: skyblue;
        padding: 10px;
        font-size: 26px;
      }

      .text-top-right {
        position: absolute;
        top: 120px;
        right: 70px;
        color: white;
        padding: 10px;
        white-space: nowrap;
        display: inline-block;
      }

    </style>
  </head>
  <body>
    <div class="container">
      <div class="card card1" onclick="redirectToAbout()">
        <div class="card-content">
          <p>About Us</p>
        </div>
      </div>
      <div class="card card2" onclick="redirectToPoki()">
        <div class="card-content">
          <p>Play Mini Games</p>
        </div>
      </div>
      <div class="card card3" onclick="redirectToInsta()">
        <div class="card-content">
          <p>Visit Socials</p>
        </div>
      </div>
      <div class="card card4" onclick="redirectToContact()">
        <div class="card-content">
          <p>See Our Contacts</p>
        </div>
      </div>
      <div class="login_box">
        <form action="index.php" method="post">
          <h1>Login</h1>
          <?php
          if (isset($_SESSION['login_error']) && $_SESSION['login_error'] === true) {
            echo '<script>alert("Incorrect Credentials! Please try again.");</script>';
            $_SESSION['login_error'] = false;
          }
          ?>
          <div class="input_box">
            <input type="text" placeholder="Username" name="username" required>
            <i class='bx bx-user'></i>
          </div>

          <div class="input_box">
            <input type="password" placeholder="Password" name="password" required>
            <i class='bx bxs-lock-alt'> </i>
          </div>

          <div  class="rem-for">
            <label> <input type="checkbox">Remember me</label>
            <a href="#">Forgot Password?</a>
          </div>
          <button type="submit" class="btn">Login</button>
          <div class="reg-link">
            <p>Don't Have An Account?
              <a href="register_page.php"> Register </a>
            </p>    
          </div>
        </form>
      </div>

      <div class="logo">
        <img src="./assets/img/newlogo.png" alt="Your Logo">
      </div>
      <div class="text-top-right">Are You A Guest? Try These!</div>
      <div class="text-top-left">CrazeWorld.com</div>
    </div>
    <script>
        function redirectToPoki() {
        window.location.href = "https://www.poki.com";
      }
      function redirectToInsta() {
        window.location.href = "https://www.instagram.com";
      }
      function redirectToContact() {
        window.location.href = "contacts.php";
      }
      function redirectToAbout() {
        window.location.href = "about_us.php";
      }
    </script>
  </body>
</html>