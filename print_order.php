<?php
include('config.php');
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = mysqli_query($conn, "SELECT * FROM orders WHERE order_ID = $id");
    $order = mysqli_fetch_assoc($query);
} else {
    die("رقم الطلب غير محدد");
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>فاتورة طلب #<?php echo $id; ?></title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap');
        body { font-family: 'Cairo', sans-serif; padding: 20px; text-align: center; color: #333; background: #fff; }
        .invoice-box { border: 2px solid #ff85a2; padding: 20px; border-radius: 15px; width: 350px; margin: auto; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        
        /* تنسيق الشعار */
        .logo { width: 100px; height: 100px; object-fit: contain; margin-bottom: 10px; }
        
        .header { border-bottom: 2px dashed #ff85a2; margin-bottom: 20px; padding-bottom: 10px; }
        .header h2 { color: #d63384; margin: 5px 0; font-size: 22px; }
        
        .details { text-align: right; line-height: 2; font-size: 14px; }
        .details b { color: #d63384; }
        
        .total { font-size: 22px; color: #d63384; font-weight: bold; margin-top: 20px; padding: 10px; border: 1px solid #ff85a2; border-radius: 10px; background: #fff5f7; }
        
        .footer { margin-top: 30px; font-size: 12px; color: #777; border-top: 1px solid #eee; pt: 10px; }
        
        /* إخفاء الزر عند الطباعة الحقيقية */
        @media print { 
            .btn-print-now { display: none; } 
            body { padding: 0; }
            .invoice-box { border: none; box-shadow: none; width: 100%; }
        }
        
        .btn-print-now { background: #d63384; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; margin-top: 20px; font-family: 'Cairo'; }
    </style>
</head>
<body onload="window.print()">

    <div class="invoice-box">
        <img src="images/logo.jpeg" alt="Velvet Sweets Logo" class="logo">
        
        <div class="header">
            <h2>Velvet Sweets ✨</h2>
            <p>فاتورة شراء رسمية</p>
        </div>
        
        <div class="details">
            <b>رقم الطلب:</b> #<?php echo $order['order_ID']; ?><br>
            <b>رقم العميل:</b> <?php echo $order['order_number']; ?><br>
            <b>تاريخ الطلب:</b> <?php echo $order['order_date']; ?><br>
            <b>حالة الطلب:</b> <?php echo isset($order['status']) ? $order['status'] : 'مقبول'; ?><br>
        </div>

        <div class="total">
            المبلغ الإجمالي: <?php echo $order['total']; ?> ريال
        </div>

        <div class="footer">
            شكراً لثقتكم بمذاقنا! 🍰<br>
            اليمن - صنعاء<br>
            نتمنى لكم يوماً سعيداً
        </div>
    </div>

    <br>
    <button class="btn-print-now" onclick="window.print()">طباعة الآن</button>
</body>
</html>