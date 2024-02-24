<?php
session_start();
include 'dbconnect.php';

if (mysqli_connect_error()) {
    die(mysqli_connect_error($con));
}

$selected_game = $_GET['selected_game'];
$_SESSION['selected_game'] = $selected_game;

$sql = "SELECT game_details FROM games WHERE game_name = '$selected_game';";
$result = mysqli_query($con, $sql);

if (!$result) {
    die(mysqli_error($con));
}

$row = mysqli_fetch_assoc($result);


$text_file = $row['game_details'];
$game_details = file_get_contents("./textfiles/$text_file");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details For Game</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        .background {
            width: 100vw;
            height: 100vh;
            background: url(./assets/img/bg5.png);
            filter: brightness(100%);
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 16px;
            text-align: center;
            font-family: 'Cursive', sans-serif;
        }

        .box {
          width: 400px;
          height: 300px;
          background-color: white;
          display: flex;
          flex-direction: column;
          align-items: center;
          justify-content: right;
          border-radius: 10px;
          animation: increaseSize 1s ease-in-out forwards;
          color: transparent;
          line-height: 2;
          padding: 0 20px;
        }

        @keyframes increaseSize {
            0% {
                width: 500px;
                height: 500px;
                color:tranparent
            }
            100% {
                width: 800px;
                height: 500px;
                color:black;
            }
        }
        .close-button {
          position: absolute;
          top: 60px;
          right: 230px;
          cursor: pointer;
          color:black;
        }

    </style>
</head>
<body>
    <div class="background">
        <div class="close-button" onclick="closeWindow()">X</div>
        <div class="box">
            <h2>Details for <?php echo $selected_game; ?></h2>
            <p><?php echo nl2br($game_details); ?></p>
        </div>
    </div>
    <script>
        function closeWindow() {
          window.location.href = 'user_page.php';
        }
    </script>
</body>
</html>

