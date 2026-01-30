<?php
session_start();

if (isset($_GET['name']) && isset($_GET['price'])) {
    $p_name = $_GET['name'];
    $p_price = $_GET['price'];

    // إذا لم تكن السلة موجودة، ننشئها كصفوف فارغة
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // إضافة المنتج الجديد للمصفوفة
    $_SESSION['cart'][] = [
        'name' => $p_name,
        'price' => $p_price
    ];

    echo "success";
}
?>