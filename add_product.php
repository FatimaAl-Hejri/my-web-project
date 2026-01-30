<?php 
include 'config.php'; // تأكدي أن ملف الاتصال اسمه config.php أو غيريه لـ db_connect.php
include 'header.php'; 

if(isset($_POST['add_sweet'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['desc'];
    $cat_id = $_POST['category_id']; 

    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    
    // التعديل هنا ليتناسب مع مجلدك (صور)
    $folder = "صور/" . $image_name;

    $sql = "INSERT INTO products (product_name, price, description, product_image, category_ID) 
            VALUES ('$name', '$price', '$description', '$image_name', '$cat_id')";

    if(mysqli_query($conn, $sql)){
        // سطر النقل الفعلي للمجلد
        move_uploaded_file($image_tmp, $folder);
        echo "<script>alert('تمت إضافة الحلوى بنجاح!'); window.location='manage_products.php';</script>";
    } else {
        echo "خطأ في الإضافة: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .form-container { max-width: 600px; margin: 50px auto; background: white; padding: 30px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .form-container h2 { color: #d63384; text-align: center; margin-bottom: 25px; }
        .form-control, .form-select { margin-bottom: 15px; border-radius: 8px; }
        .btn-submit { background-color: #d63384; color: white; width: 100%; padding: 10px; border-radius: 8px; border: none; font-size: 18px; transition: 0.3s; }
        .btn-submit:hover { background-color: #b82a6e; }
    </style>
</head>
<body>

<div class="form-container">
    <h2>🍰 إضافة صنف جديد</h2>
    <form id="uploadForm" action="add_product.php" method="POST" enctype="multipart/form-data">
        
        <label class="form-label">اسم الحلوى:</label>
        <input type="text" name="name" class="form-control" placeholder="مثلاً: Chocolate Cake" required>
        
        <label class="form-label">السعر:</label>
        <input type="number" name="price" class="form-control" placeholder="0.00" required>
        
        <label class="form-label">الوصف:</label>
        <textarea name="desc" class="form-control" rows="3" placeholder="اكتبي وصفاً مشهياً هنا..."></textarea>
        
        <label class="form-label">اختر القسم:</label>
        <select name="category_id" class="form-select">
            <?php
            $cats = mysqli_query($conn, "SELECT * FROM categorys");
            while($row = mysqli_fetch_assoc($cats)){
                echo "<option value='".$row['category_ID']."'>".$row['category_name']."</option>";
            }
            ?>
        </select>

        <label class="form-label">صورة الحلوى:</label>
        <input type="file" name="image" id="product_image" class="form-control" required>
        
        <button type="submit" name="add_sweet" class="btn btn-submit mt-3">حفظ المنتج في المحل</button>
        <a href="manage_products.php" class="btn btn-link w-100 mt-2 text-secondary text-decoration-none">إلغاء والعودة للوحة الإدارة</a>
    </form>
</div>

<script>
// كود الفحص الأمني الذي أرسلتيه (ممتاز جداً)
document.getElementById('uploadForm').onsubmit = function(e) {
    const fileInput = document.getElementById('product_image');
    const filePath = fileInput.value;
    const allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    
    if (!allowedExtensions.exec(filePath)) {
        alert('تنبيه: لا يمكنك رفع هذا الملف! يرجى اختيار صورة فقط (jpg, jpeg, png).');
        fileInput.value = '';
        e.preventDefault();
        return false;
    }
    
    if (fileInput.files[0].size > 2 * 1024 * 1024) {
        alert('تنبيه: حجم الصورة كبير جداً، يرجى اختيار صورة أصغر من 2 ميجابايت.');
        e.preventDefault();
        return false;
    }
};
</script>

</body>
</html>