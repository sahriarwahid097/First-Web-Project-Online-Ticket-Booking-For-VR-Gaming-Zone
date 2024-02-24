<?php
session_start();
include 'dbconnect.php';
$admin_name = mysqli_real_escape_string($con, $_SESSION['admin_name']);
$admin_id = mysqli_real_escape_string($con, $_SESSION['admin_id']);
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f4f4f4;
        }

        .container {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)),
                url(./assets/img/admin_bg4.jpg);
            background-position: center;
            background-size: cover;
            padding-left: 8px;
            padding-right: 8px;
            box-sizing: border-box;
        }

        .card {
            position: relative;
        }

        .card-content {
            position: absolute;
            top: 5%;
            left: 80%;
            transform: translate(-50%, -50%);
            color: white;
            text-shadow: 1px 1px 2px rgba(235, 7, 147, 0.8);
            display: none;
        }

        .card:hover .card-content {
            display: block;
        }

        .card {
            width: 250px;
            height: 200px;
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
            background-image: url(./assets/img/ticket1.png);
            position: absolute;
            bottom: 300px;
            right: 300px;
        }

        .card2 {
            background-image: url(./assets/img/update2.png);
            position: absolute;
            bottom: 300px;
            left: 300px;
        }

        .card3 {
            background-image: url(./assets/img/payment2.png);
            position: absolute;
            bottom: 5px;
            left: 300px;
        }

        .card4 {
            background-image: url(./assets/img/cancel3.png);
            position: absolute;
            bottom: 5px;
            right: 300px;
            
        }

        .logo {
            position: absolute;
            top: 0px;
            left: 5px;
            width: 100px;
            height: 100px;
        }

        .text-top-right {
          position: absolute;
          top:2px;
          right: 80px;
          color: white;
          padding: 10px;
          border: none;
          border-radius: 5px;
          white-space: nowrap; 
          display: inline-block;
          background: rgba(0, 0, 0, 10);
          transition: background 0.3s, color 0.3s;
          cursor: pointer;
        }

        .text-top-right2 {
          position: absolute;
          top:2px;
          right: 5px;
          color: white;
          padding: 10px;
          border: none;
          border-radius: 5px;
          white-space: nowrap; 
          display: inline-block;
          background: rgba(0, 0, 0, 10);
          transition: background 0.3s, color 0.3s;
          cursor: pointer;
        }
        .text-top-right3 {
          position: absolute;
          top:65px;
          right: 780px;
          color: white;
          padding: 10px;
        }

        .text-top-right4 {
          position: absolute;
          top:350px;
          right: 760px;
          color: white;
          padding: 10px;
        }

        .text-top-right5 {
          position: absolute;
          top:350px;
          right: 360px;
          color: white;
          padding: 10px;
        }

        .text-top-right6 {
          position: absolute;
          top:60px;
          right: 360px;
          color: white;
          padding: 10px;
        }

        .text-top-right:hover,
        .text-top-right2:hover {
            background: white;
            color: black;
        }

        .text-top-right7 {
          position: absolute;
          top:5px;
          right: 1090px;
          color: yellow;
          padding: 10px;
        }

        .text-top-right8 {
          position: absolute;
          top:40px;
          right: 1115px;
          color: lightgreen;
          background: rgba(0, 0, 0, 10);
          padding: 1px;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="card card1" onclick="redirecttoticket()">
        </div>
        <div class="card card2" onclick="redirecttoupdate()">
        </div>
        <div class="card card3" onclick="redirecttopayment()">
        </div>
        <div class="card card4" onclick="redirecttocancel()">
        </div>


        <div class="logo" alt="Your Logo">
            <img src="./assets/img/adminlogo.png">
        </div>
        <div class="text-top-right" onclick="redirecttoprofile()">Profile</div>
        <div class="text-top-right2" onclick="logoutAdmin()">Logout</div>
        <div class="text-top-right3">Update Games</div>
        <div class="text-top-right4">Manage Payments</div>
        <div class="text-top-right5">View Cancellations</div>
        <div class="text-top-right6">Manage Tckets</div>
        <div class="text-top-right7">Logged in as</div>
        <div class="text-top-right8"><?php echo $_SESSION['admin_name'];?></div>
    </div>
    <script>
        function redirecttopayment() {
            window.location.href = "payment_admin.php";
        }

        function redirecttocancel() {
            window.location.href = "admin_cancel.php";
        }

        function logoutAdmin() {
            if (confirm('Are you sure you want to logout?')) {
                window.location.href = 'logout.php';
            }
        }

        function redirecttoupdate() {
            window.location.href = "update_game_details.php";
        }

        function redirecttoticket() {
            window.location.href = "admin_ticket.php";
        }

        function redirecttoprofile() {
            window.location.href = "admin_profile.php";
        }
        
        
    </script>
</body>
</html>