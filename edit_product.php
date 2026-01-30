<?php 
include 'db.php'; // تأكد من اسم ملف الاتصال

if (!isset($_GET['id'])) { die("خطأ: لم يتم تحديد المنتج."); }
$id = $_GET['id'];

// 1. تحديد المفتاح الأساسي وأسماء الأعمدة (بناءً على قاعدة بياناتك)
$primary_key = 'product_ID'; 
$name_col = 'product_name'; 
$price_col = 'price';
$image_col = 'product_image'; // اسم عمود الصورة في جدولك

// 2. جلب بيانات المنتج الحالية
$result = mysqli_query($conn, "SELECT * FROM products WHERE $primary_key = $id");
$row = mysqli_fetch_assoc($result);

if (!$row) { die("المنتج غير موجود."); }

// 3. معالجة التحديث
if (isset($_POST['update'])) {
    $new_name = mysqli_real_escape_string($conn, $_POST['name']);
    $new_price = $_POST['price'];
    $new_desc = mysqli_real_escape_string($conn, $_POST['desc']);
    
    // التحقق مما إذا كان المستخدم رفع صورة جديدة
    if (!empty($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $folder = "images/" . $image_name;
        
        move_uploaded_file($image_tmp, $folder);
        // تحديث البيانات مع الصورة الجديدة
        $update_sql = "UPDATE products SET $name_col='$new_name', $price_col='$new_price', description='$new_desc', $image_col='$image_name' WHERE $primary_key = $id";
    } else {
        // تحديث البيانات بدون تغيير الصورة الحالية
        $update_sql = "UPDATE products SET $name_col='$new_name', $price_col='$new_price', description='$new_desc' WHERE $primary_key = $id";
    }
    
    if (mysqli_query($conn, $update_sql)) {
        echo "<script>alert('تم تحديث المنتج بنجاح ✨'); window.location.href='manage_products.php';</script>";
        exit();
    } else {
        echo "خطأ أثناء التحديث: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تعديل منتج | Velvet Sweets</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo&display=swap');
        body { font-family: 'Cairo', sans-serif; background-color: #fff5f7; padding: 50px 0; }
        .edit-card { max-width: 600px; margin: auto; border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1); background: white; }
        .btn-update { background-color: #d63384; color: white; border: none; padding: 12px; border-radius: 12px; font-weight: bold; }
        .current-img { width: 120px; height: 120px; object-fit: cover; border-radius: 15px; border: 2px solid #ffb7c5; margin-bottom: 15px; }
    </style>
</head>
<body>

<div class="container">
    <div class="card edit-card p-4">
        <h3 class="text-center mb-4" style="color: #d63384;">تعديل بيانات المنتج</h3>
        
        <form method="POST" enctype="multipart/form-data">
            
            <div class="text-center">
                <p class="mb-1 text-muted">الصورة الحالية:</p>
                <img src="images/<?php echo $row[$image_col]; ?>" class="current-img" onerror="this.src='images/logo.jpeg'">
            </div>

            <div class="mb-3">
                <label class="form-label">اسم المنتج</label>
                <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($row[$name_col]); ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">السعر (ريال)</label>
                <input type="number" name="price" class="form-control" value="<?php echo $row[$price_col]; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">الوصف</label>
                <textarea name="desc" class="form-control" rows="3"><?php echo htmlspecialchars($row['description']); ?></textarea>
            </div>

            <div class="mb-4">
                <label class="form-label">تغيير الصورة (اختياري)</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
            
            <button type="submit" name="update" class="btn btn-update w-100 mb-2">حفظ التغييرات ✨</button>
            <a href="manage_products.php" class="btn btn-light w-100">إلغاء والعودة</a>
        </form>
    </div>
</div>

</body>
</html>