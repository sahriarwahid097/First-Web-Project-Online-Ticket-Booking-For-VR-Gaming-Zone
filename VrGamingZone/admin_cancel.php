<?php
session_start();
include 'dbconnect.php';

if (mysqli_connect_error()) {
    die(mysqli_connect_error($con));
}

$admin_name = mysqli_real_escape_string($con, $_SESSION['admin_name']);
$admin_id = mysqli_real_escape_string($con, $_SESSION['admin_id']);

$sql = "SELECT cancellation.cancellation_no,user.Username, 
        ticket.reg_no,payment.transaction_id,payment.status AS payment_status,payment.amount,ticket.date,
        cancellation.refund_amount,cancellation.requested,cancellation.status AS cancellation_status,
        ticket.admin_id
        FROM user
        JOIN ticket ON user.user_id = ticket.user_id
        JOIN payment ON ticket.reg_no = payment.reg_no
        JOIN cancellation ON payment.reg_no = cancellation.reg_no";
        

$result = mysqli_query($con, $sql);

if (!$result) {
    die(mysqli_error($con));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
       body {
            background: url(./assets/img/admin_bg4.jpg) no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        select {
            padding: 5px;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #4caf50; 
            color: white;
            padding: 7px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
    <title>admin_cancel</title>
</head>
<body>
<div style="text-align: center; margin-bottom: 100px;">
    <form method="get" action="admin_page.php">
        <input type="submit" value="Go to Home Page">
    </form>
<?php
echo '<table>';
echo '<tr><th>Cancellation No.</th><th>Ticket Date</th><th>Username</th><th>Registration No</th><th>Transaction ID</th><th>Payment Status</th><th>Paid Amount</th><th>Refundable Amount</th><th>Issued By</th><th>Cancellation Status</th></tr>';

while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>' . $row['cancellation_no'] . '</td>';
    echo '<td>' . $row['date'] . '</td>';
    echo '<td>' . $row['Username'] . '</td>';
    echo '<td>' . $row['reg_no'] . '</td>';
    echo '<td>' . $row['transaction_id'] . '</td>';
    echo '<td>' . $row['payment_status'] . '</td>';
    echo '<td>' . $row['amount'] . '</td>';
    echo '<td>' . $row['refund_amount'] . '</td>';
    echo '<td>' . $row['admin_id'] . '</td>';
    echo '<td>' . $row['cancellation_status'] . '</td>';
    echo '<td>';
    echo '<form method="post" action="cancel_status.php">';
    echo '<input type="hidden" name="cancellation_no" value="' . $row['cancellation_no'] . '">';
    echo '<select name="status">';
    echo '<option value="accepted">Accept</option>';
    echo '<option value="rejected">Reject</option>';
    echo '</select>';
    echo '<input type="submit" value="Submit">';
    echo '</form>';
    echo '</td>';
    echo '</tr>';
}


echo '</table>';
?>

</body>
</html>

