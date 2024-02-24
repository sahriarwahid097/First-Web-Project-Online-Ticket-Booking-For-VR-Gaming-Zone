<?php
session_start();
include 'dbconnect.php';

if (mysqli_connect_error()) {
    die(mysqli_connect_error($con));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $transactionID = $_POST['transactionID'];
    $ticketRegNo = $_POST['Ticket_Reg_No'];
    $user_name = $_SESSION['user_name'];
    $user_id = $_SESSION['user_id'];
    $game_id = $_SESSION['game_id'];
    $quantity = $_SESSION['quantity'];
    $game_fee = $_SESSION['game_fee'];
    $date = $_SESSION['date'];
    $time = $_SESSION['time'];

    $insertTicket = "INSERT INTO ticket (reg_no, user_id, game_id, quantity, date, time) 
    VALUES ('$ticketRegNo', '$user_id', '$game_id', '$quantity', '$date', '$time')";

    if (mysqli_query($con, $insertTicket)) {
        $paymentAmount = $game_fee * $quantity;
        $insertPayment = "INSERT INTO payment (transaction_id, amount, status, user_id, reg_no) 
        VALUES ('$transactionID', '$paymentAmount', 'pending', '$user_id', '$ticketRegNo')";

        if (mysqli_query($con, $insertPayment)) {
            echo '<script>';
            echo 'window.location.href = "user_page.php";'; 
            echo 'alert("Ticket booked! Payment in processing.");';
            echo '</script>';
            exit();
        } else {
            die(mysqli_connect_error($con));
        }
    }
}
?>

