<?php 
// 1. الاتصال بقاعدة البيانات
include('config.php'); 

// 2. كود الحذف السريع (إذا تم استخدام الرابط في نفس الصفحة)
if (isset($_GET['delete_id'])) {
    $id_to_delete = $_GET['delete_id'];
    $sql_delete = "DELETE FROM products WHERE product_ID = $id_to_delete";
    if (mysqli_query($conn, $sql_delete)) {
        echo "<script>alert('تم حذف الصنف بنجاح ✨'); window.location='manage_products.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة التحكم | إدارة الحلويات</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap');
        body { font-family: 'Cairo', sans-serif; background-color: #fff5f7; }
        .product-img { width: 60px; height: 60px; object-fit: cover; border-radius: 8px; border: 1px solid #ff85a2; }
        .main-card { border-radius: 20px; border: none; box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
        .navbar { background-color: #2d3436 !important; }
        .table thead { background-color: #ff85a2; color: white; }
        .btn-success { background-color: #d63384; border: none; } /* وردي غامق للتعديل */
        .btn-success:hover { background-color: #b92a6e; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark p-3 shadow">
    <div class="container">
        <a class="navbar-brand" href="#">🍬 Velvet Sweets - الإدارة</a>
        <div class="navbar-nav ms-auto">
            <a class="nav-link active" href="manage_products.php">📦 إدارة الحلويات</a>
            <a class="nav-link" href="manage_orders.php">🛒 الطلبات</a>
            <a class="nav-link" href="admin_messages.php">✉️ الرسائل</a>
            <a class="nav-link" href="manage_categories.php">أضافه اصناف</a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="main-card card p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 style="color: #d63384;">إدارة قائمة الحلويات</h2>
            <a href="add_product.php" class="btn btn-success btn-lg">إضافة حلى جديد +</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle text-center">
                <thead>
                    <tr>
                        <th>المعرف</th>
                        <th>الصورة</th>
                        <th>اسم الصنف</th>
                        <th>السعر</th>
                        <th>التصنيف</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // جلب البيانات مع التأكد من اسم عمود المعرف
                    $query = "SELECT * FROM products ORDER BY product_ID DESC";
                    $result = mysqli_query($conn, $query);
                    
                    if ($result && mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td class="fw-bold">#<?php echo $row['product_ID']; ?></td>
                                <td>
                                    <img src="images/<?php echo $row['product_image']; ?>" class="product-img" onerror="this.src='https://via.placeholder.com/60?text=No+Img'">
                                </td>
                                <td><?php echo $row['product_name']; ?></td>
                                <td class="text-success fw-bold"><?php echo $row['price']; ?> ريال</td>
                                <td><span class="badge bg-light text-dark border"><?php echo $row['category_ID']; ?></span></td>
                                <td>
                                    <a href="edit_product.php?id=<?php echo $row['product_ID']; ?>" class="btn btn-sm btn-success" title="تعديل">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a href="delete_product.php?id=<?php echo $row['product_ID']; ?>" 
                                       class="btn btn-sm btn-danger" 
                                       onclick="return confirm('هل أنتِ متأكدة من حذف (<?php echo $row['product_name']; ?>)؟')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='6' class='p-5 text-muted'>لا توجد منتجات مضافة حالياً.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>