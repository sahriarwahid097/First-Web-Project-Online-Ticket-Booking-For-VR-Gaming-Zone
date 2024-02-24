<?php
session_start();
include 'dbconnect.php';

if (mysqli_connect_error()) {
    die(mysqli_connect_error());
}

$username = mysqli_real_escape_string($con, $_SESSION['user_name']);
$sql = "SELECT Email, Phone, Password FROM user WHERE Username='$username'";
$result = mysqli_query($con, $sql);

if (!$result) {
    die(mysqli_error($con));
}

$email = '';
$phone = '';
$password = '';

while ($row = mysqli_fetch_assoc($result)) {
    $email = $row['Email'];
    $phone = $row['Phone'];
    $password = $row['Password'];
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>userprofile</title>
    <style>
        body {
            margin: 0;
            padding: 0;
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

        .table-container {
            width: 800px;
            height: 500px;
            background-color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            animation: increaseSize 1s ease-in-out forwards;
            color: black;
            line-height: 2;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        @keyframes increaseSize {
            0% {
                width: 500px;
                height: 300px;
            }
            100% {
                width: 800px;
                height: 500px;
            }
        }

        .close-button {
          position: absolute;
          top: 55px;
          right: 250px;
          cursor: pointer;
        }

    </style>
</head>
<body>
    <div class="background">
        <div class="table-container">
          <div class="close-button" onclick="closeWindow()">X</div>
            <h2>Profile Info</h2>
            <table>
                <tr>
                    <th>Username</th>
                    <td><?php echo $_SESSION['user_name'];?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo $email;?></td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td><?php echo $phone;?></td>
                </tr>
                <tr>
                    <th>Password</th>
                    <td><?php echo $password;?></td>
                </tr>
            </table>
        </div>
    </div>

    <script>
        function closeWindow() {
          window.location.href = 'user_page.php';
        }
    </script>
</body>
</html>
