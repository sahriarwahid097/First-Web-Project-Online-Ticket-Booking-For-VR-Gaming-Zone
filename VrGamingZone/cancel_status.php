<?php
session_start();
include 'dbconnect.php';

if (mysqli_connect_error()) {
    die(mysqli_connect_error($con));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cancellation_no = mysqli_real_escape_string($con, $_POST['cancellation_no']);
    $status = mysqli_real_escape_string($con, $_POST['status']);
    $admin_id = $_SESSION['admin_id'];


    $updatePayment= "UPDATE cancellation SET status = '$status' WHERE cancellation_no = '$cancellation_no'";
    $updatePaymentResult = mysqli_query($con, $updatePayment);

    if (!$updatePaymentResult) {
        die(mysqli_error($con));
    }

    header('Location: admin_cancel.php');
    exit();
} else {
    header('Location: admin_cancel.php');
    exit();
}
?>

