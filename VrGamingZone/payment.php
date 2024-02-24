<?php
session_start();
include 'dbconnect.php';

if (mysqli_connect_error()) {
    die(mysqli_connect_error($con));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user_name = $_SESSION['user_name'];
    $game_id = $_SESSION['game_id'];
    $game_fee = $_SESSION['game_fee'];
    $game_name = $_SESSION['selected_game'];
    $quantity = $_POST['quantity'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    $_SESSION['quantity'] = $quantity;
    $_SESSION['date'] = $date;
    $_SESSION['time'] = $time;
}

function generateTicketRegNo() {
    return mt_rand(0000000001, 00000100000);
}


function generateTransactionID() {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $transactionID = '';
    for ($i = 0; $i < 10; $i++) {
        $transactionID .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $transactionID;
}


$ticketRegNo = generateTicketRegNo();
$transactionID = generateTransactionID();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>payment</title>
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
          justify-content: center;
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
                color: transparent;
            }
            100% {
                width: 800px;
                height: 500px;
                color: black;
            }
        }

        
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 80%;
            margin: auto;
            padding: 20px; 
        }
    
        input {
            margin: 10px 0;
            padding: 12px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            margin-top: 5px;
            padding: 8px;
            background-color: green;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: white;
            color: black;
        }

        
    </style>
</head>
<body>
    <div class="background">
        <div class="box">
            <h2>Payment</h2>
            <form action="done.php" method="post">
                <label for="ticket_reg_no">Enter This Ticket Reg No : <?php echo " $ticketRegNo";?></label>
                <input type="text" name="Ticket Reg No">
                <label for="transactionID">Enter Transaction ID: <?php echo"(Example: $transactionID)";?></label>
                <input type="text" name="transactionID">
                <label for="ticket price">Ticket Price</label>
                <input type="text" name="ticket price" value="<?php echo $game_fee; ?>" readonly>
                <label for="Total Amount">Total Amount</label>
                <input type="text" name="Total Amount" value="<?php echo $quantity*$game_fee; ?>" readonly>
                <button type="submit">Proceed to payment</button>
            </form>
        </div>
    </div>
</body>
</html>