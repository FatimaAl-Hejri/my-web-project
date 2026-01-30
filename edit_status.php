<?php 
include 'config.php'; 

// 1. استقبال الـ ID والتأكد من وجوده
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // جلب بيانات الرسالة
    $result = mysqli_query($conn, "SELECT * FROM contact_messages WHERE id = $id");
    
    if($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        die("الرسالة غير موجودة.");
    }
}

// 2. معالجة طلب التحديث
if(isset($_POST['update'])) {
    $new_status = $_POST['status'];
    
    // التصحيح هنا: اسم العمود هو contact_msg وليس اسم الجدول
    $update_query = "UPDATE contact_messages SET contact_msg = '$new_status' WHERE id = $id";
    
    if(mysqli_query($conn, $update_query)) {
        header("Location: admin_messages.php");
        exit();
    } else {
        echo "خطأ في التحديث: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تعديل الحالة | Velvet Sweets</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo&display=swap');
        body { font-family: 'Cairo', sans-serif; background: #fff5f7; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .edit-card { background: white; padding: 30px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); width: 350px; text-align: center; }
        h3 { color: #d63384; margin-bottom: 20px; }
        select { width: 100%; padding: 10px; border-radius: 10px; border: 1px solid #f8bbd0; margin-bottom: 20px; outline: none; font-family: 'Cairo'; }
        button { background: #d63384; color: white; border: none; padding: 10px 20px; border-radius: 10px; cursor: pointer; width: 100%; font-weight: bold; font-family: 'Cairo'; }
        button:hover { background: #880e4f; }
        .back-link { display: block; margin-top: 15px; color: #666; text-decoration: none; font-size: 0.9rem; }
    </style>
</head>
<body>
    <div class="edit-card">
        <h3>تعديل حالة الطلب</h3>
        <p>العميلة: <strong><?php echo $row['name']; ?></strong></p>
        
        <form method="POST">
            <select name="status">
                <option value="جديد" <?php if($row['contact_msg'] == 'جديد') echo 'selected'; ?>>جديد ✨</option>
                <option value="تم التواصل" <?php if($row['contact_msg'] == 'تم التواصل') echo 'selected'; ?>>تم التواصل ✅</option>
                <option value="تم الحلم" <?php if($row['contact_msg'] == 'تم الحل') echo 'selected'; ?>>تم الحل 🌸</option>
                <option value="مرفوض" <?php if($row['contact_msg'] == 'مرفوض') echo 'selected'; ?>>مرفوض ❌</option>
            </select>
            <button type="submit" name="update">حفظ التغييرات</button>
            <a href="admin_messages.php" class="back-link">إلغاء والعودة</a>
        </form>
    </div>
</body>
</html>