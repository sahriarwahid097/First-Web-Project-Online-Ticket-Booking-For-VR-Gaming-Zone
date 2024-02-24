<?php
session_start();
include 'dbconnect.php';

if (mysqli_connect_error()) {
    die(mysqli_connect_error($con));
}
$admin_name = mysqli_real_escape_string($con, $_SESSION['admin_name']);
$admin_id = mysqli_real_escape_string($con, $_SESSION['admin_id']);

$sql = "SELECT * FROM ticket";

$result = mysqli_query($con, $sql);
if (!$result) {
  die(mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <h2>Manage Tickets</h2>
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
        h2 {
            text-align: center;
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
    <title>manage tickets</title>

</head>
<body>

<?php
echo '<table>';
echo '<tr><th>Ticket Registration No</th><th>game_id</th><th>Quantity</th>
<th>Date</th><th>Time</th></tr>';

while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>' . $row['reg_no'] . '</td>';
    echo '<td>' . $row['game_id'] . '</td>';
    echo '<td>' . $row['quantity'] . '</td>';
    echo '<td>' . $row['date'] . '</td>';
    echo '<td>' . $row['time'] . '</td>';
    echo '<td>
            <form method="post" action="delete_ticket.php">
              <input type="hidden" name="delete" value="' . $row['reg_no'] . '">
              <input type="submit" value="Delete">
            </form>
          </td>';
    echo '</tr>';
}
?>
</table>
<div style="text-align: center; margin-top: 50px;">
    <form method="get" action="admin_page.php">
        <input type="submit" value="Go to Home Page">
    </form>
</body>
</html>
