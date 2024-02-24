<?php
session_start();
include 'dbconnect.php';

if (mysqli_connect_error()) {
    die(mysqli_connect_error($con));
}

$admin_name = mysqli_real_escape_string($con, $_SESSION['admin_name']);
$admin_id = mysqli_real_escape_string($con, $_SESSION['admin_id']);
$sql ="SELECT games.game_id, games.game_name,games.game_fee ,games.slots,
games.booked_slots,games.game_details
FROM admin
JOIN vrzone ON admin.domain_name = vrzone.domain_name
JOIN games ON games.domain_name = vrzone.domain_name
WHERE admin.username = '{$admin_name}'";
$result = mysqli_query($con, $sql);

if (!$result) {
    die(mysqli_error($con));
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <h2>Upadate Game Details</h2>
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
    <title>update_game_details</title>

</head>
<body>

<?php
echo '<form method="post" action="updated.php">';

echo '<table>';
echo '<tr><th>Game ID</th><th>Game Name</th><th>Game Fee</th>
<th>Slots</th><th>Booked Slots</th><th>Text File</th></tr>';

while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td><input type="hidden" name="game_id[]" value="' . $row['game_id'] . '">' . $row['game_id'] . '</td>';
    echo '<td>' . $row['game_name'] . '</td>';
    echo '<td><input type="text" name="game_fee[]" class="editable" value="' . $row['game_fee'] . '"></td>';
    echo '<td><input type="text" name="slots[]" class="editable" value="' . $row['slots'] . '"></td>';
    echo '<td><input type="text" name="booked_slots[]" class="editable" value="' . $row['booked_slots'] . '"></td>';
    echo '<td><input type="text" name="text_file[]" class="editable" value="' . $row['game_details'] . '"></td>';
    echo '</tr>';
}

echo '</table>';

echo '<input type="submit" name="update" value="Update">'; 
echo '</form>';
?>
<div style="text-align: center; margin-top: 50px;">
    <form method="get" action="admin_page.php">
        <input type="submit" value="Go to Home Page">
    </form>

</body>
</html>