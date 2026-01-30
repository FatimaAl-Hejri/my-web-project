<?php
include('config.php');
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM orders WHERE order_ID = $id");
header("Location: manage_orders.php"); // تأكدي من اسم صفحتك هنا
?>