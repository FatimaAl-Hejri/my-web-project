<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>إدارة الطلبات | Velvet Sweets</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap');
        body { font-family: 'Cairo', sans-serif; background-color: #f8f9fa; }
        .main-card { border-radius: 20px; border: none; }
        .table thead { background-color: #ff85a2; color: white; }
        .btn-print { background-color: #0d6efd; border: none; color: white; }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark p-3 shadow-sm">
    <div class="container d-flex justify-content-between">
        <a class="navbar-brand" href="#">📦 نظام إدارة الطلبات</a>
        <a class="btn btn-outline-light btn-sm" href="manage_products.php">
            <i class="fas fa-th-large"></i> التحكم المركزية
        </a>
    </div>
</nav>

<div class="container mt-5">
    <div class="main-card card shadow p-4">
        <h2 class="text-center mb-4" style="color: #d63384;">سجل الطلبات الواردة</h2>
        
        <div class="table-responsive">
            <table class="table table-hover align-middle text-center">
                <thead>
                    <tr>
                        <th>رقم الطلب</th>
                        <th>رقم الهاتف</th>
                        <th>التاريخ</th>
                        <th>الإجمالي</th>
                        <th>الحالة</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $res = mysqli_query($conn, "SELECT * FROM orders ORDER BY order_ID DESC");
                    if (mysqli_num_rows($res) > 0) {
                        while($row = mysqli_fetch_assoc($res)) { 
                            $status = isset($row['status']) ? $row['status'] : 'قيد الانتظار';
                            $badge_color = ($status == 'مكتمل') ? 'bg-success' : 'bg-info';
                        ?>
                        <tr>
                            <td class="fw-bold">#<?php echo $row['order_ID']; ?></td>
                            <td><?php echo $row['order_number']; ?></td>
                            <td><?php echo $row['order_date']; ?></td>
                            <td class="text-success fw-bold"><?php echo $row['total']; ?> ريال</td>
                            <td><span class="badge <?php echo $badge_color; ?> p-2"><?php echo $status; ?></span></td>
                            <td>
                                <a href="print_order.php?id=<?php echo $row['order_ID']; ?>" target="_blank" class="btn btn-sm btn-print" title="طباعة الفاتورة">
                                   <i class="fas fa-print"></i>
                                </a>

                                <a href="update_order.php?id=<?php echo $row['order_ID']; ?>&status=مكتمل" class="btn btn-sm btn-success" title="تم التجهيز">
                                   <i class="fas fa-check"></i>
                                </a>

                                <a href="delete_order.php?id=<?php echo $row['order_ID']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('حذف الطلب؟')">
                                   <i class="fas fa-trash"></i>

                                </a>
                            </td>
                        </tr>
                        <?php } 
                    } else { echo "<tr><td colspan='6'>لا توجد طلبات حالياً</td></tr>"; } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>