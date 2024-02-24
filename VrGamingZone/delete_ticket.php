<?php
session_start();
include 'dbconnect.php';

if (mysqli_connect_error()) {
    die(mysqli_connect_error($con));
}

if (isset($_POST['delete'])) {
    $reg_no = mysqli_real_escape_string($con, $_POST['delete']);


    $delete_cancel = "DELETE FROM cancellation WHERE reg_no = '$reg_no'";
    $delete_cancel_result = mysqli_query($con, $delete_cancel);

    if (!$delete_cancel_result) {
        die(mysqli_error($con));
    }
    
   
    $delete_payment = "DELETE FROM payment WHERE reg_no = '$reg_no'";
    $delete_payment_result = mysqli_query($con, $delete_payment);

    if (!$delete_payment_result) {
        die(mysqli_error($con));
    }

    $delete_ticket = "DELETE FROM ticket WHERE reg_no = '$reg_no'";
    $delete_ticket_result = mysqli_query($con, $delete_ticket);

    if (!$delete_ticket_result) {
        die(mysqli_error($con));
    }
    header("Location: admin_ticket.php");
    exit();
}
?>