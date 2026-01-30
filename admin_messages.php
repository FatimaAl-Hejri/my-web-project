<?php 
include 'config.php'; 
// جلب البيانات من الجدول
$query = "SELECT * FROM contact_messages ORDER BY id DESC";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة التحكم | Velvet Sweets</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap');
        body { font-family: 'Cairo', sans-serif; background: #fff5f7; padding: 40px; margin: 0; }
        .admin-container { max-width: 1100px; margin: auto; background: white; padding: 30px; border-radius: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        
        /* تنسيق الهيدر العلوي ليحتوي على العنوان والزر */
        .admin-header { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            margin-bottom: 30px; 
            border-bottom: 2px dashed #fce4ec;
            padding-bottom: 20px;
        }
        
        h2 { color: #d63384; margin: 0; }
        
        /* زر الرجوع للتحكم المركزية */
        .btn-main-control {
            background: #d63384;
            color: white;
            padding: 10px 20px;
            border-radius: 15px;
            text-decoration: none;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: 0.3s;
            box-shadow: 0 5px 15px rgba(214, 51, 132, 0.2);
        }
        .btn-main-control:hover {
            background: #880e4f;
            transform: translateY(-3px);
            color: white;
        }

        table { width: 100%; border-collapse: collapse; }
        th { background: #ff85a2; color: white; padding: 15px; text-align: center; }
        td { padding: 15px; border-bottom: 1px solid #fce4ec; text-align: center; vertical-align: middle; }
        .status-badge { padding: 5px 15px; border-radius: 20px; font-size: 0.85rem; background: #fce4ec; color: #d63384; font-weight: bold; border: 1px solid #ff85a2; }
        .btn-edit { background: #28a745; color: white; padding: 8px 15px; border-radius: 10px; text-decoration: none; margin-left: 5px; display: inline-block; }
        .btn-delete { background: #dc3545; color: white; padding: 8px 15px; border-radius: 10px; text-decoration: none; display: inline-block; }
        .btn-edit:hover, .btn-delete:hover { opacity: 0.8; transform: scale(1.05); transition: 0.2s; }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="admin-header">
            <h2><i class="fas fa-magic"></i> إدارة رسائل Velvet Sweets</h2>
            
            <a href="manage_products.php" class="btn-main-control">
                <i class="fas fa-th-large"></i> التحكم المركزية
            </a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>البريد</th>
                    <th>الرسالة</th>
                    <th>الحالة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($row['name']); ?></strong></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['message']); ?></td>
                    
                    <td>
                        <span class="status-badge">
                            <?php 
                                // تصحيح بسيط: استخدام اسم العمود الصحيح contact_msg كما في الكود السابق
                                echo (!empty($row['contact_msg'])) ? $row['contact_msg'] : 'جديد ✨'; 
                            ?>
                        </span>
                    </td>
                    
                    <td>
                        <a href="edit_status.php?id=<?php echo $row['id']; ?>" class="btn-edit" title="تعديل الحالة">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="delete_message.php?id=<?php echo $row['id']; ?>" class="btn-delete" title="حذف" onclick="return confirm('هل أنتِ متأكدة من حذف هذه الرسالة؟')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>