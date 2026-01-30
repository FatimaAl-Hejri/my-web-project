<?php 
include 'config.php'; 

// 1. معالجة البيانات برمجياً
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // تأكدي من وجود عمود contact_msg في قاعدة البيانات أو احذفيه من الاستعلام إذا لم يكن موجوداً
    $sql = "INSERT INTO contact_messages (name, email, message, contact_msg) 
            VALUES ('$name', '$email', '$message', 'جديد')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('تم الإرسال بنجاح! ✨'); window.location.href='contact.php';</script>";
        exit();
    } else {
        echo "خطأ: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تواصل معنا | Velvet Sweets</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&family=Pacifico&display=swap');

        /* 1. تنسيق الخلفية العامة */
        body {
            font-family: 'Cairo', sans-serif;
            margin: 0;
            background: linear-gradient(135deg, #fff5f7 0%, #fce4ec 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* 2. حاوية المحتوى */
        .page-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 50px 20px;
            position: relative;
        }

        /* 3. تأثير الصور العائمة */
        .floating-img {
            position: fixed;
            width: 120px;
            height: 120px;
            border-radius: 25px;
            object-fit: cover;
            z-index: 1; 
            opacity: 1 !important;
            visibility: visible !important;
            box-shadow: 0 10px 20px rgba(214, 51, 132, 0.3);
            pointer-events: none;
        }

        .img1 { top: 15%; right: 5%; animation: float 5s infinite; }
        .img2 { top: 20%; left: 5%; animation: float 6s infinite; }
        .img3 { bottom: 10%; right: 8%; animation: float 7s infinite; }
        .img4 { bottom: 15%; left: 8%; animation: float 5.5s infinite; }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(10deg); }
        }

        /* 4. تصميم الصندوق الرئيسي */
        .contact-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 40px;
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            max-width: 1000px;
            width: 100%;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(255, 182, 193, 0.3);
            z-index: 10;
        }

        .info-section {
            background: #ff85a2;
            padding: 50px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 25px;
        }

        .info-section h2 { font-family: 'Pacifico', cursive; font-size: 2.5rem; margin: 0; }
        
        .contact-item {
            display: flex;
            align-items: center;
            gap: 15px;
            background: rgba(255, 255, 255, 0.2);
            padding: 15px;
            border-radius: 20px;
            transition: 0.3s;
        }
        .contact-item:hover { background: rgba(255, 255, 255, 0.3); transform: scale(1.05); }

        .form-section {
            padding: 50px;
            background: white;
        }

        .form-section h3 { color: #880e4f; margin-bottom: 25px; font-size: 1.8rem; }

        .input-group { margin-bottom: 20px; position: relative; }
        
        input, textarea {
            width: 100%;
            padding: 15px;
            border: 2px solid #fce4ec;
            border-radius: 15px;
            outline: none;
            transition: 0.3s;
            font-size: 1rem;
            box-sizing: border-box;
        }

        input:focus, textarea:focus { border-color: #ff85a2; box-shadow: 0 0 10px rgba(255, 133, 162, 0.2); }

        .submit-btn {
            background: #d63384;
            color: white;
            border: none;
            padding: 15px 40px;
            border-radius: 15px;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            transition: 0.3s;
        }
        .submit-btn:hover { background: #880e4f; transform: translateY(-3px); box-shadow: 0 10px 20px rgba(136, 14, 79, 0.3); }

        @media (max-width: 768px) {
            .contact-card { grid-template-columns: 1fr; margin-top: 20px; }
            .floating-img { width: 60px; height: 60px; }
        }
    </style>
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="page-wrapper">
        <img src="images/nav5.jpeg" class="floating-img img1">
        <img src="images/nav6.jpeg" class="floating-img img2">
        <img src="images/nav3.jpeg" class="floating-img img3">
        <img src="images/nav8.jpeg" class="floating-img img4">

        <div class="contact-card">
            <div class="info-section">
                <h2>Velvet Sweets</h2>
                <p>نحن هنا لنسمع منك! شاركينا رأيك أو استفسارك.</p>
                
                <div class="contact-item">
                    <i class="fas fa-phone-alt"></i>
                    <span>+967 783427614</span>
                </div>
                <div class="contact-item">
                    <i class="fab fa-whatsapp"></i>
                    <span>واتساب</span>
                </div>
                <div class="contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>اليمن - صنعاء</span>
                </div>
            </div>
            <script>
// ربط الكود بالنموذج لما نضغط على زر الإرسال
//document.getElementById('uploadForm').onsubmit = function(e) {
   // const fileInput = document.getElementById('product_image');
   // const filePath = fileInput.value;
    
    //onst allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    
    // الفحص: إذا لم يكن الملف ينتهي بإحدى هذه الصيغ يعني لا يقبل اي ملف او صور غير هذه الصيغ
   // if (!allowedExtensions.exec(filePath)) {
      //  alert('تنبيه: لا يمكنك رفع هذا الملف! يرجى اختيار صورة فقط (jpg, jpeg, png).');
       // fileInput.value = ''; // يمسح اختيار الملف الخاطئ
       // e.preventDefault(); // يوقف إرسال النموذج نهائياً
       // return false;
    //}
    
    //  يمنع الملفات الي اكبر من 2 ميجا
    //if (fileInput.files[0].size > 2 * 1024 * 1024) {
       // alert('تنبيه: حجم الصورة كبير جداً، يرجى اختيار صورة أصغر من 2 ميجابايت.');
       // e.preventDefault();
       // return false;
   // }
 //};
//</script>
            <div class="form-section">
                <h3>أرسلي لنا رسالة ✨</h3>
                <form action="contact.php" method="POST">
                    <div class="input-group">
                        <input type="text" name="name" placeholder="اسمك اللطيف" required>
                    </div>
                    <div class="input-group">
                        <input type="email" name="email" placeholder="البريد الإلكتروني" required>
                    </div>
                    <div class="input-group">
                        <textarea name="message" rows="4" placeholder="كيف يمكننا إسعادك؟" required></textarea>
                    </div>
                    <button type="submit" class="submit-btn">إرسال بحب <i class="fas fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>