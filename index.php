<?php 
include 'db.php'; 
include 'header.php'; 
?>

<style>
    /* توحيد خلفية الصفحة بالكامل بنفس لون السلايدر */
    body { 
        background-color: #fff5f7; 
        margin: 0; 
        font-family: 'Cairo', sans-serif; 
    }

    /* زر وصول سريع للأدمن (اختياري) */
    .admin-fast-link {
        position: absolute;
        top: 120px;
        right: 20px;
        background: #d63384;
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        text-decoration: none;
        font-size: 0.8rem;
        z-index: 100;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .slider-box { perspective: 1000px; padding: 40px 0; overflow: hidden; height: 450px; position: relative; }
    .carousel-container { display: flex; justify-content: center; align-items: center; position: relative; height: 100%; }
    .slide-item { width: 300px; height: 380px; border-radius: 20px; background-size: cover; background-position: center; position: absolute; transition: 0.8s ease-in-out; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
    .p1 { transform: translateX(-300px) scale(0.8); z-index: 1; opacity: 0.5; }
    .p2 { transform: translateX(0) scale(1.1); z-index: 3; opacity: 1; border: 4px solid #fff; }
    .p3 { transform: translateX(300px) scale(0.8); z-index: 1; opacity: 0.5; }

    .cat-section { padding: 60px 20px; text-align: center; }
    .cat-grid { display: flex; flex-wrap: wrap; justify-content: center; gap: 25px; margin-top: 30px; }
    .cat-card { width: 220px; text-decoration: none; color: #333; background: #fff; padding: 15px; border-radius: 20px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); transition: 0.3s; border: 2px solid transparent; }
    .cat-card:hover { transform: translateY(-10px); border-color: #ffb7c5; }
    .cat-card img { width: 100%; height: 180px; border-radius: 15px; object-fit: cover; }
    
    .features-section {
        display: grid; 
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); 
        gap: 20px; 
        padding: 40px 20px; 
        text-align: center; 
        background: transparent; 
        direction: rtl;
    }
    .feature-item {
        padding: 20px; 
        border: 1px dashed #ffb7c5; 
        border-radius: 15px; 
        background: rgba(255, 255, 255, 0.4); 
    }
</style>

<a href="manage_categories.php" class="admin-fast-link">⚙️ إدارة الأصناف</a>

<div class="slider-box">
    <div class="carousel-container">
        <div class="slide-item p1" style="background-image: url('images/nav34.jpeg');"></div>
        <div class="slide-item p2" style="background-image: url('images/nav11.jpeg');"></div>
        <div class="slide-item p3" style="background-image: url('images/nav28.jpeg');"></div>
    </div>
</div>

<div class="cat-section">
    <h2 style="color: #331a1e;"><span>✨ أصنافنا المميزة ✨</span></h2>
    <div class="cat-grid">
        <?php
        // جلب الأصناف المضافة من صفحة الإدارة تلقائياً
        $cat_res = mysqli_query($conn, "SELECT * FROM categorys");
        if(mysqli_num_rows($cat_res) > 0) {
            while($cat = mysqli_fetch_assoc($cat_res)) {
                $c_name = $cat['category_name'];
                $c_id   = $cat['category_ID'];
                $c_img  = $cat['category_image'];
        ?>
            <a href="products.php?cat_id=<?php echo $c_id; ?>" class="cat-card">
                <img src="images/<?php echo $c_img; ?>" 
                     onerror="this.src='images/logo.jpeg';">
                <h4 style="margin-top:15px; color:#d63384;"><?php echo $c_name; ?></h4>
            </a>
        <?php 
            } 
        } else {
            echo "<p style='color:#777;'>لا توجد أصناف حالياً، قم بإضافتها من لوحة الإدارة.</p>";
        }
        ?>
    </div>
</div>

<section class="features-section">
    <div class="feature-item">
        <span style="font-size: 2.5rem;">🍓</span>
        <h4 style="color: #331a1e;">جودة المكونات</h4>
        <p style="font-size: 0.9rem; color: #777;">نستخدم أفضل المكونات الطازجة لضمان طعم لا يقاوم.</p>
    </div>
    <div class="feature-item">
        <span style="font-size: 2.5rem;">👩‍🍳</span>
        <h4 style="color: #331a1e;">صنع بحب</h4>
        <p style="font-size: 0.9rem; color: #777;">كل قطعة تُصنع بعناية فائقة لتناسب ذوقكم الرفيع.</p>
    </div>
    <div class="feature-item">
        <span style="font-size: 2.5rem;">🎁</span>
        <h4 style="color: #331a1e;">تغليف فاخر</h4>
        <p style="font-size: 0.9rem; color: #777;">تصلكم حلوياتنا بتغليف أنيق يليق بمناسباتكم السعيدة.</p>
    </div>
</section>

<script>
    function rotate() {
        const items = document.querySelectorAll('.slide-item');
        const classes = ['p1', 'p2', 'p3'];
        items.forEach((item) => {
            let currentClass = Array.from(item.classList).find(c => classes.includes(c));
            let nextIndex = (classes.indexOf(currentClass) + 1) % 3;
            item.classList.remove(currentClass);
            item.classList.add(classes[nextIndex]);
        });
    }
    setInterval(rotate, 3500);
</script>

<?php include 'footer.php'; ?>