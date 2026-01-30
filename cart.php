<?php 
session_start();
include 'db.php'; 
include 'header.php'; 

// كود حذف منتج معين من السلة
if (isset($_GET['remove'])) {
    $index = $_GET['remove'];
    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        // إعادة ترتيب المصفوفة لتجنب فجوات المفاتيح
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
    header("Location: cart.php");
    exit();
}

$total_price = 0;
?>

<div style="max-width: 900px; margin: 50px auto; padding: 20px; background: #fff; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
    <h2 style="text-align: center; color: #d63384; margin-bottom: 30px;">🛒 سلة المشتريات</h2>

    <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
        <table style="width: 100%; border-collapse: collapse; text-align: right;">
            <thead>
                <tr style="border-bottom: 2px solid #fdf2f4; color: #666;">
                    <th style="padding: 15px;">المنتج</th>
                    <th style="padding: 15px;">السعر</th>
                    <th style="padding: 15px;">إجراء</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['cart'] as $index => $item): 
                    $total_price += $item['price'];
                ?>
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 15px; font-weight: bold;"><?php echo $item['name']; ?></td>
                        <td style="padding: 15px;"><?php echo $item['price']; ?> ريال</td>
                        <td style="padding: 15px;">
                            <a href="cart.php?remove=<?php echo $index; ?>" style="color: #ff4d4d; text-decoration: none; font-size: 0.9rem; border: 1px solid #ff4d4d; padding: 5px 10px; border-radius: 5px;">حذف 🗑️</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div style="margin-top: 30px; padding: 20px; background: #fff5f7; border-radius: 15px; display: flex; justify-content: space-between; align-items: center;">
            <h3 style="margin: 0; color: #d63384;">المجموع الإجمالي:</h3>
            <h2 style="margin: 0; color: #d63384;"><?php echo $total_price; ?> ريال</h2>
        </div>

<div style="text-align: center; margin-top: 30px;">
    <a href="checkout_process.php" 
       style="background: #28a745; color: white; text-decoration: none; padding: 15px 40px; border-radius: 30px; font-size: 1.1rem; display: inline-block; font-weight: bold;">
       إتمام الطلب ✅
    </a>
</div>

    <?php else: ?>
        <div style="text-align: center; padding: 50px;">
            <p style="font-size: 1.2rem; color: #999;">سلتك فارغة حالياً.. اذهب وتسوق أشهى الحلويات!</p>
            <a href="products.php" style="display: inline-block; margin-top: 20px; color: #d63384; text-decoration: none; font-weight: bold;">← العودة للمنتجات</a>
        </div>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>