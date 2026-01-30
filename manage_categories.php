<?php 
include 'db.php'; 
include 'header.php'; 

if(isset($_POST['add_cat'])){
    $cat_name = mysqli_real_escape_string($conn, $_POST['cat_name']);
    
    // بيانات الملف
    $file = $_FILES['cat_img'];
    $img_name = $file['name'];
    $img_tmp = $file['tmp_name'];
    $file_ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION)); // جلب امتداد الملف
    
    // تحديد الامتدادات المسموح بها فقط
    $allowed = array('jpg', 'jpeg', 'png', 'gif', 'webp');

    // الفحص البرمجي (PHP)
    if(in_array($file_ext, $allowed)){
        $new_name = time() . '_' . $img_name; // تسمية فريدة للملف
        $folder = "images/" . $new_name;

        if(move_uploaded_file($img_tmp, $folder)){
            $sql = "INSERT INTO categorys (category_name, category_image) VALUES ('$cat_name', '$new_name')";
            if(mysqli_query($conn, $sql)){
                echo "<script>alert('✅ تم إضافة الصنف بنجاح!'); window.location='manage_categories.php';</script>";
            }
        }
    } else {
        // رسالة الخطأ في حال كان الملف ليس صورة
        echo "<script>alert('❌ خطأ: يرجى رفع ملف صورة فقط (JPG, PNG, WebP)!');</script>";
    }
}

// (كود الحذف يبقى كما هو)
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM categorys WHERE category_ID = $id");
    header("Location: manage_categories.php");
}
?>

<div style="padding: 40px; font-family: 'Cairo', sans-serif; direction: rtl; background: #fff5f7; min-height: 100vh;">
    
    <div style="max-width: 500px; margin: 0 auto 40px; background: white; padding: 25px; border-radius: 20px; box-shadow: 0 10px 20px rgba(0,0,0,0.05);">
        <h3 style="color: #d63384; text-align: center; margin-bottom: 20px;">✨ إضافة صنف جديد</h3>
        
        <form id="catForm" action="" method="POST" enctype="multipart/form-data">
            <label>اسم الصنف:</label>
            <input type="text" name="cat_name" placeholder="مثلاً: قسم الكيك" style="width:100%; padding:12px; margin: 10px 0; border-radius:10px; border:1px solid #ddd;" required>
            
            <label>صورة الصنف:</label>
            <input type="file" name="cat_img" id="cat_img" accept="image/*" style="width:100%; margin: 10px 0;" required>
            
            <button type="submit" name="add_cat" style="width:100%; background:#d63384; color:white; border:none; padding:12px; border-radius:10px; font-weight:bold; cursor:pointer; margin-top:10px;">حفظ الصنف</button>
        </form>
    </div>

    <div style="max-width: 900px; margin: 0 auto; background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 20px rgba(0,0,0,0.05);">
        <table style="width: 100%; border-collapse: collapse; text-align: center;">
            <thead style="background: #ffb7db;">
                <tr>
                    <th style="padding: 15px;">الصورة</th>
                    <th>اسم الصنف</th>
                    <th>الإجراء</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $res = mysqli_query($conn, "SELECT * FROM categorys");
                while($row = mysqli_fetch_assoc($res)){
                    echo "<tr style='border-bottom: 1px solid #eee;'>
                            <td style='padding: 10px;'><img src='images/".$row['category_image']."' style='width: 70px; height: 70px; border-radius: 50%; object-fit: cover;'></td>
                            <td style='font-weight: bold;'>".$row['category_name']."</td>
                            <td><a href='?delete=".$row['category_ID']."' onclick='return confirm(\"هل أنت متأكد؟\")' style='color: #ff4d4d; text-decoration: none;'>❌ حذف</a></td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
// فحص الجافا سكريبت (قبل الإرسال)
document.getElementById('catForm').onsubmit = function(e) {
    const fileInput = document.getElementById('cat_img');
    const filePath = fileInput.value;
    // الامتدادات المسموحة
    const allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|\.webp)$/i;
    
    if (!allowedExtensions.exec(filePath)) {
        alert('تنبيه: لا يمكنك رفع هذا النوع من الملفات! يرجى اختيار صورة فقط (jpg, png, webp).');
        fileInput.value = '';
        e.preventDefault(); // منع إرسال الفورم
        return false;
    }
};
</script>