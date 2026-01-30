<?php
// 1. الاتصال بقاعدة البيانات
include 'config.php';

// 2. التأكد من إرسال رقم الرسالة (ID) عبر الرابط
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // 3. أمر الحذف - تأكدي أن اسم الجدول contact_messages واسم العمود id
    $query = "DELETE FROM contact_messages WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        // 4. إذا نجح الحذف، العودة لصفحة الأدمن فوراً
        header("Location: admin_messages.php?msg=deleted");
        exit();
    } else {
        // في حال حدوث خطأ
        echo "خطأ في عملية الحذف: " . mysqli_error($conn);
    }
} else {
    // إذا حاول شخص دخول الصفحة بدون رقم ID
    header("Location: admin_messages.php");
    exit();
}
?>