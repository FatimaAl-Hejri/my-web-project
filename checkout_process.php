<?php
session_start();
include 'db.php';

// التحقق من وجود سلة
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    header("Location: cart.php");
    exit();
}

$total_sum = 0;
foreach ($_SESSION['cart'] as $item) {
    $total_sum += $item['price'];
}

$order_date = date("Y-m-d");
$status = "قيد الانتظار";
$phone = "05xxxxxxx"; // يفضل جلب رقم العميل من جلسة تسجيل الدخول مستقبلاً
$order_number = "ORD-" . rand(1000, 9999);

// 1. إدخال الطلب في جدول orders
$sql = "INSERT INTO orders (order_number, order_date, total, phone, status) 
        VALUES ('$order_number', '$order_date', '$total_sum', '$phone', '$status')";

if (mysqli_query($conn, $sql)) {
    $order_id = mysqli_insert_id($conn);
    
    // 2. إدخال تفاصيل المنتجات في جدول order_detail
    foreach ($_SESSION['cart'] as $item) {
        $p_name = mysqli_real_escape_string($conn, $item['name']);
        $p_price = $item['price'];
        $qty = 1; // القيمة الافتراضية

        $sql_detail = "INSERT INTO order_detail (order_id, product_name, quantity, unit_price, total_price) 
                       VALUES ('$order_id', '$p_name', '$qty', '$p_price', '$p_price')";
        mysqli_query($conn, $sql_detail);
    } 

    // 3. تفريغ السلة بعد نجاح العملية
    unset($_SESSION['cart']);

    // 4. إظهار رسالة النجاح وتوجيه العميل لصفحة "الرئيسية" وليس الإدارة
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>"; // استخدام SweetAlert لمظهر احترافي
    echo "<body></body>"; // لتسهيل ظهور الرسالة
    echo "<script>
            document.body.style.fontFamily = 'Cairo';
            setTimeout(function() {
                alert('شكراً لك! تم استلام طلبك بنجاح. رقم الطلب الخاص بك هو: #$order_id');
                window.location.href = 'index.php'; 
            }, 100);
          </script>";
} else {
    // في حالة الخطأ يبقى العميل في صفحة السلة مع إظهار تنبيه
    echo "<script>
            alert('عذراً، حدث خطأ أثناء إتمام الطلب. يرجى المحاولة لاحقاً.');
            window.location.href = 'cart.php';
          </script>";
}
?>