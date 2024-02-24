<?php
session_start();
include 'dbconnect.php';

if (mysqli_connect_error()) {
    die(mysqli_connect_error($con));
}

$user_name = mysqli_real_escape_string($con, $_SESSION['user_name']);
$user_id = mysqli_real_escape_string($con, $_SESSION['user_id']);

$sql = "SELECT games.game_id, games.game_name
        FROM user
        JOIN vrzone ON user.domain_name = vrzone.domain_name
        JOIN games ON games.domain_name = vrzone.domain_name
        WHERE user.Username = '{$user_name}'";

$result = mysqli_query($con, $sql);

if (!$result) {
    die(mysqli_error($con));
}

$game_id = array();
$game_name = array();

while ($row = mysqli_fetch_assoc($result)) {
    $game_id[] = $row['game_id'];
    $game_name[] = $row['game_name'];
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
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
                url(./assets/img/bg5.png);
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
            top: 100%;
            left: 50%;
            align-items: center;
            transform: translate(-50%, -50%);
            color: white;
            display: flex;
            text-shadow: 1px 1px 2px rgba(235, 7, 147, 0.8);
        }

        .card:hover .card-content {
            display: block;
        }

        .card {
            width: 150px;
            height: 150px;
            display: inline-block;
            border-radius: 10px;
            border: 1px solid lightgreen;
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

        .card-content button {
            background-color: transparent;
            color: white;
            border: 2px solid lightgreen;
            border-color: lightgreen;
            padding: 8px 12px;
            margin: 5px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s, color 0.3s;
            margin-right: 10px;
        }

        .card-content button:hover {
            background-color: white;
            color: black;
        }

        .card-text {
            position: absolute;
            top: -15%; 
            left: 50%;
            transform: translateX(-50%);
            color: white;
            text-shadow: 1px 1px 2px rgba(235, 7, 147, 0.8);
            font-size: 16px;
            white-space: nowrap;
        }
        

        .card1 {
        background-image: url(./assets/img/lasertag.jpg);
        position: absolute;
        bottom: 260px;
        right: 960px;
        }
        .card2 {
        background-image: url(./assets/img/flight.jpg);
        position: absolute;
        bottom: 260px;
        right: 760px;
        }
        .card3 {
        background-image: url(./assets/img/beatsaber.jpg);
        position: absolute;
        bottom: 260px;
        right: 560px;
        }

        .card4 {
        background-image: url(./assets/img/boxing.jpg);
        position: absolute;
        bottom: 260px;
        right: 360px;
        }

        .card5 {
        background-image: url(./assets/img/archary2.jpg);
        position: absolute;
        bottom: 260px;
        right: 160px;
        }

        .card6 {
        background-image: url(./assets/img/rollercoaster2.jpg);
        position: absolute;
        bottom: 50px;
        right: 960px;
        }
        .card7 {
        background-image: url(./assets/img/basket.jpg);
        position: absolute;
        bottom: 50px;
        right: 760px;
        }
        .card8 {
        background-image: url(./assets/img/table2.jpg);
        position: absolute;
        bottom: 50px;
        right: 560px;
        }

        .card9 {
        background-image: url(./assets/img/car.jpg);
        position: absolute;
        bottom: 50px;
        right: 360px;
        }

        .card10 {
        background-image: url(./assets/img/bike.jpg);
        position: absolute;
        bottom: 50px;
        right: 160px;
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
          right: 95px;
          color: white;
          padding: 10px;
          border: none;
          border-radius: 5px;
          white-space: nowrap; 
          display: inline-block;
          background: lightgreen;
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
          background: lightgreen;
          transition: background 0.3s, color 0.3s;
          cursor: pointer;
        }
       

        .text-top-right:hover,
        .text-top-right2:hover,
        .text-top-right9:hover{
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
          right: 1095px;
          color: lightgreen;
          background: rgba(0, 0, 0, 10);
          padding: 1px;
        }

        .text-top-right9 {
          position: absolute;
          top:2px;
          right: 180px;
          color: white;
          padding: 10px;
          border: none;
          border-radius: 5px;
          white-space: nowrap; 
          display: inline-block;
          background: lightgreen;
          transition: background 0.3s, color 0.3s;
          cursor: pointer;
        }

        .text-top-right10 {
            position: absolute;
            top: 70px;
            right: 620px;
            color: lightgreen;
            background: transparent;
            padding: 10px;
            font-size: 30px;
            font-weight: bold;
            border: 2px solid skyblue;
            border-radius: 5px;
            animation: glowingBorder 1s infinite;
        }

        @keyframes glowingBorder {
            0% {
                border-color: skyblue;
                box-shadow: 0 0 10px rgba(0, 128, 0, 0.5);
            }
            50% {
                border-color: rgba(0, 128, 0, 0.5); 
                box-shadow: 0 0 20px rgba(0, 128, 0, 0.8); 
            }
            100% {
                border-color: skyblue;
                box-shadow: 0 0 10px rgba(0, 128, 0, 0.5)
            }
        }

    </style>



</head>
<body>
    <div class="container">
        <div class="logo" alt="Your Logo">
            <img src="./assets/img/usericon4.png">
        </div>
        <div class="text-top-right9" onclick="redirecttobookings()"">Bookings</div>
        <div class="text-top-right" onclick="redirecttoprofile()">Profile</div>
        <div class="text-top-right2" onclick="logoutUser()">Logout</div>
        <div class="text-top-right7">Logged in as</div>
        
        <div class="text-top-right8"><?php echo $_SESSION['user_name'];?></div>
        <div class="text-top-right10">Games</div>
        <div class="card card1">
            <div class="card-text"><?php echo $game_name[0];?></div>
            <div class="card-content">
                <button onclick="showDetails('<?php echo $game_name[0]; ?>')">Details</button>
                <button onclick="buyTicket('<?php echo $game_name[0]; ?>')">Book</button>
            </div>
        </div>

        <div class="card card2">
            <div class="card-text"><?php echo $game_name[1];?></div>
            <div class="card-content">
                <button onclick="showDetails('<?php echo $game_name[1]; ?>')">Details</button>
                <button onclick="buyTicket('<?php echo $game_name[1]; ?>')">Book</button>
            </div>
        </div>
        <div class="card card3">
            <div class="card-text"><?php echo $game_name[2];?></div>
            <div class="card-content">
                <button onclick="showDetails('<?php echo $game_name[2]; ?>')">Details</button>
                <button onclick="buyTicket('<?php echo $game_name[2]; ?>')">Book</button>
            </div>
        </div>
        <div class="card card4">
            <div class="card-text"><?php echo $game_name[3];?></div>
            <div class="card-content">
                <button onclick="showDetails('<?php echo $game_name[3]; ?>')">Details</button>
                <button onclick="buyTicket('<?php echo $game_name[3]; ?>')">Book</button>
            </div>
        </div>
        <div class="card card5">
            <div class="card-text"><?php echo $game_name[4];?></div>
            <div class="card-content">
                <button onclick="showDetails('<?php echo $game_name[4]; ?>')">Details</button>
                <button onclick="buyTicket('<?php echo $game_name[4]; ?>')">Book</button>
            </div>
        </div>
        <div class="card card6">
           <div class="card-text"><?php echo $game_name[5];?></div>
            <div class="card-content">
                <button onclick="showDetails('<?php echo $game_name[5]; ?>')">Details</button>
                <button onclick="buyTicket('<?php echo $game_name[5]; ?>')">Book</button>
            </div>
        </div>
        <div class="card card7">
            <div class="card-text"><?php echo $game_name[6];?></div>
            <div class="card-content">
                <button onclick="showDetails('<?php echo $game_name[6]; ?>')">Details</button>
                <button onclick="buyTicket('<?php echo $game_name[6]; ?>')">Book</button>
            </div>
        </div>
        <div class="card card8">
            <div class="card-text"><?php echo $game_name[7];?></div>
            <div class="card-content">
                <button onclick="showDetails('<?php echo $game_name[7]; ?>')">Details</button>
                <button onclick="buyTicket('<?php echo $game_name[7]; ?>')">Book</button>
            </div>
        </div>
        <div class="card card9">
            <div class="card-text"><?php echo $game_name[8];?></div>
            <div class="card-content">
                <button onclick="showDetails('<?php echo $game_name[8]; ?>')">Details</button>
                <button onclick="buyTicket('<?php echo $game_name[8]; ?>')">Book</button>
            </div>
        </div>
        <div class="card card10">
            <div class="card-text"><?php echo $game_name[9];?></div>
            <div class="card-content">
                <button onclick="showDetails('<?php echo $game_name[9]; ?>')">Details</button>
                <button onclick="buyTicket('<?php echo $game_name[9]; ?>')">Book</button>
            </div>
        </div>
    </div>

    <script>
        function logoutUser() {
            if (confirm('Are you sure you want to logout?')) {
                window.location.href = 'logout.php';
            }
        }

        function showDetails(gameName) {
            window.location.href = 'detailpage.php?selected_game=' + encodeURIComponent(gameName);}

        function buyTicket(gameName) {
            var confirmation = confirm("Do you want to buy a ticket for " + gameName + "?");
            if (confirmation) {
                window.location.href = 'ticket.php?selected_game=' + encodeURIComponent(gameName);
            }
        }

        function redirecttoprofile() {
            window.location.href = 'userprofile.php';
        }

        function redirecttobookings() {
            window.location.href = 'bookings.php';
        }

    </script>
</body>
</html>