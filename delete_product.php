<?php
include 'config.php'; // تأكدي أن هذا اسم ملف الاتصال عندك

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // كود ذكي لمعرفة اسم العمود (id أو p_id) وحذفه
    $table_info = mysqli_query($conn, "SHOW KEYS FROM products WHERE Key_name = 'PRIMARY'");
    $primary_key = mysqli_fetch_assoc($table_info)['Column_name'];

    $query = "DELETE FROM products WHERE $primary_key = $id";
    
    if (mysqli_query($conn, $query)) {
        header("Location: manage_products.php?msg=deleted");
        exit();
    } else {
        echo "خطأ أثناء الحذف: " . mysqli_error($conn);
    }
}
?>