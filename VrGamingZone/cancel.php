<?php
session_start();
include 'dbconnect.php';

if (mysqli_connect_error()) {
    die(mysqli_connect_error($con));
}

$user_id = mysqli_real_escape_string($con, $_SESSION['user_id']);
$reg_no = mysqli_real_escape_string($con, $_GET['reg_id']);

$sql = "SELECT amount,transaction_id FROM payment WHERE reg_no='$reg_no'";
$result = mysqli_query($con, $sql);

if (!$result) {
    die(mysqli_connect_error($con));
}

$payment=mysqli_fetch_assoc($result);
$amount = $payment['amount'];
$transactionId = $payment['transaction_id'];


$insert = "INSERT INTO cancellation (refund_amount,requested,status,reg_no,transaction_id)
 VALUES ($amount,'yes','pending','$reg_no','$transactionId')";
$resultInsert = mysqli_query($con, $insert);

if (!$resultInsert) {
    die('Error: ' . mysqli_error($con));
}
header('Location: user_page.php');
?>
