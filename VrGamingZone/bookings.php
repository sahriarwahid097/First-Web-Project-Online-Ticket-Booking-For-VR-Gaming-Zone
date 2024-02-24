<?php
session_start();
include 'dbconnect.php';

if (mysqli_connect_error()) {
    die(mysqli_connect_error($con));
}

$user_name = mysqli_real_escape_string($con, $_SESSION['user_name']);
$user_id = mysqli_real_escape_string($con, $_SESSION['user_id']);

$query = "SELECT * FROM ticket WHERE user_id = '$user_id'";
$result = mysqli_query($con, $query);

if (!$result) {
    die('Error: ' . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cancelBooking</title>
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
          width: 800px; 
          height: 500px;
          background-color: lightgreen;
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

        table {
            width: 100%;
            border-radius: 10px;
        }

        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        @keyframes increaseSize {
            0% {
                width: 500px;
                height: 500px;
                color: transparent;
            }
            100% {
                width: 800px;
                height: 500px;
                color: black;
            }
        }

        .close-button {
          position: absolute;
          top: 60px;
          right: 230px;
          cursor: pointer;
          color: black;
        }
        button {
            background-color: #ff0000;
            color: #ffffff; 
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
          background-color: #cc0000; 
        }

    </style>
</head>
<body>
    <div class="background">
        <div class="close-button" onclick="closeWindow()">X</div>
        <div class="box">
            <h2>My Bookings</h2>
            <table>
                <tr>
                    <th>Reg. No</th>
                    <th>Game ID</th>
                    <th>Quantity</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Cancel</th>
                </tr>
                <?php
               
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['reg_no']}</td>";
                    echo "<td>{$row['game_id']}</td>";
                    echo "<td>{$row['quantity']}</td>";
                    echo "<td>{$row['date']}</td>";
                    echo "<td>{$row['time']}</td>";
                    echo "<td><button onclick='cancelBooking({$row['reg_no']})'>Cancel</button></td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>
    <script>
        function closeWindow() {
          window.location.href = 'user_page.php';
        }

        function cancelBooking(regNo) {
             window.location.href = 'cancel.php?reg_id=' + regNo;
        }
    </script>
</body>
</html>
