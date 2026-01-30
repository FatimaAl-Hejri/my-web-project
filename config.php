<?php
// بيانات الاتصال بالسيرفر المحلي (XAMPP)
$host = "localhost";
$user = "root";
$pass = "";
$db_name = "velvet_sweets"; // تأكدي أن هذا هو اسم قاعدة بياناتك بالضبط في phpMyAdmin

// إنشاء الاتصال
$conn = mysqli_connect($host, $user, $pass, $db_name);

// التأكد من نجاح الاتصال
if (!$conn) {
    die("فشل الاتصال بقاعدة البيانات: " . mysqli_connect_error());
}

// ضبط الترميز لدعم اللغة العربية بشكل صحيح
mysqli_set_charset($conn, "utf8");
?>