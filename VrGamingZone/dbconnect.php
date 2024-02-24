<?php
$HOSTNAME= 'localhost';
$USERNAME= 'root';
$Password= '';
$DATABASE= 'vr_gaming';

$con= mysqli_connect($HOSTNAME,$USERNAME,$Password,$DATABASE);

if (!$con){
  die(mysqli_error($con));
}
?>