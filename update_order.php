<?php
include('config.php');
$id = $_GET['id'];
$status = $_GET['status'];
mysqli_query($conn, "UPDATE orders SET status = '$status' WHERE order_ID = $id");
header("Location: manage_orders.php");
?>