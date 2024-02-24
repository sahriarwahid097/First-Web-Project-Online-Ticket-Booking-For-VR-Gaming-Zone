<?php
session_start();
include 'dbconnect.php';

if (mysqli_connect_error()) {
    die(mysqli_connect_error($con));
}

if (isset($_POST['update'])) {
    $game_fee = $_POST['game_fee'];
    $slots = $_POST['slots'];
    $booked_slots = $_POST['booked_slots'];
    $text_file = $_POST['text_file'];
    $game_ids = $_POST['game_id'];

    foreach ($game_ids as $key => $game_id) {
        $game_fee_value = mysqli_real_escape_string($con, $game_fee[$key]);
        $slots_value = mysqli_real_escape_string($con, $slots[$key]);
        $booked_slots_value = mysqli_real_escape_string($con, $booked_slots[$key]);
        $text_file_value = mysqli_real_escape_string($con, $text_file[$key]);

        $updateGames = "UPDATE games SET game_fee = '$game_fee_value', slots = '$slots_value', 
        booked_slots = '$booked_slots_value', game_details = '$text_file_value' 
        WHERE game_id = '$game_id'";

        $result = mysqli_query($con, $updateGames);

        if (!$result) {
            die(mysqli_error($con));
        }
    } 
    echo '<script>';
    echo 'alert("Game updated successfully!");';
    echo 'window.location.href = "update_game_details.php";';
    echo '</script>';
}  


?>
