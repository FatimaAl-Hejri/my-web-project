<?php 
include 'db.php'; 
include 'header.php'; 

// التأكد من جلب رقم القسم بشكل صحيح
$cat_id = isset($_GET['cat_id']) ? mysqli_real_escape_string($conn, $_GET['cat_id']) : '';

if ($cat_id != '') {
    // استخدمنا category_ID كما في صورتك لقاعدة البيانات
    $query = "SELECT * FROM products WHERE category_ID = '$cat_id'";
    $cat_info = mysqli_query($conn, "SELECT category_name FROM categorys WHERE category_ID = '$cat_id'");
    $cat_row = mysqli_fetch_assoc($cat_info);
    $title = "قسم: " . ($cat_row['category_name'] ?? "المختارات");
} else {
    $query = "SELECT * FROM products";
    $title = "كل الحلويات";
}
$res = mysqli_query($conn, $query); 
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div style="padding: 40px 20px; max-width: 1200px; margin: auto; font-family: 'Cairo', sans-serif; direction: rtl;">
    <h2 style="text-align:center; color:#d63384; margin-bottom:40px;"><span><?php echo $title; ?></span></h2>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px;">
        <?php 
        if(mysqli_num_rows($res) > 0) {
            while($row = mysqli_fetch_assoc($res)) { 
                // التعديل: التأكد من استخدام product_image كما أكدت أنت
                $imgName = !empty($row['product_image']) ? $row['product_image'] : 'logo.jpeg';
                $imgPath = "images/" . $imgName;

                // ملاحظة: تأكد أن اسم العمود في جدولك هو product_name أو name 
                // سأستخدم name لأنه الأكثر شيوعاً، غيره إذا كان مختلفاً
                $p_name = $row['product_name'] ?? $row['name'] ?? 'منتج مخملي';
        ?>
            <div style="background:#fff; border-radius:20px; padding:20px; box-shadow:0 10px 25px rgba(0,0,0,0.05); text-align:center; border:1px solid #fdf2f4; transition: 0.3s;">
                <img src="<?php echo $imgPath; ?>" style="width:100%; height:220px; object-fit:cover; border-radius:15px; margin-bottom:15px;" onerror="this.src='images/logo.jpeg'">
                
                <h3 style="color:#4a4a4a; margin-bottom:5px;"><?php echo $p_name; ?></h3>
                
                <p style="color:#777; font-size:0.9rem; margin-bottom:15px; height:40px; overflow:hidden;">
                    <?php echo $row['description'] ?? $row['product_description'] ?? 'حلوى لذيذة محضرة بكل حب'; ?>
                </p>
                
                <div style="color:#d63384; font-weight:bold; font-size:1.4rem; margin-bottom:20px;">
                    <?php echo $row['price']; ?> ريال
                </div>
                
                <button onclick="addToCart('<?php echo addslashes($p_name); ?>', '<?php echo $row['price']; ?>')" 
                        style="background: #ffb7c5; color:white; border:none; padding:12px; width:100%; border-radius:15px; cursor:pointer; font-weight:bold;">
                    إضافة للسلة 🛒
                </button>
            </div>
        <?php 
            }
        } else {
            echo "<div style='grid-column: 1/-1; text-align:center; padding:100px; color:#999;'>لا توجد منتجات حالياً في هذا القسم.</div>";
        }
        ?>
    </div>
</div>

<script>
function addToCart(name, price) {
    fetch(`add_to_cart_process.php?name=${encodeURIComponent(name)}&price=${price}`)
    .then(response => response.text())
    .then(data => {
        Swal.fire({
            title: 'تمت الإضافة!',
            text: 'تم إضافة ' + name + ' بنجاح.',
            icon: 'success',
            confirmButtonColor: '#ffb7c5'
        });
    });
}
</script>

<?php include 'footer.php'; ?>