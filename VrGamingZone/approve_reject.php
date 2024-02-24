<?php
session_start();
include 'dbconnect.php';

if (mysqli_connect_error()) {
    die(mysqli_connect_error($con));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reg_no = mysqli_real_escape_string($con, $_POST['reg_no']);
    $status = mysqli_real_escape_string($con, $_POST['status']);
    $admin_id = $_SESSION['admin_id'];


    $updatePayment= "UPDATE payment SET status = '$status' WHERE reg_no = '$reg_no'";
    $updatePaymentResult = mysqli_query($con, $updatePayment);

    if (!$updatePaymentResult) {
        die(mysqli_error($con));
    }

    $updateTicket= "UPDATE ticket SET admin_id = '$admin_id' WHERE reg_no = '$reg_no'";
    $updateTicketResult = mysqli_query($con, $updateTicket);

    if (!$updateTicketResult) {
        die(mysqli_error($con));
    }

    header('Location: payment_admin.php');
    exit();
} else {
    header('Location: payment_admin.php');
    exit();
}
?>

