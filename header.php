<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        :root { --main-pink: #d6679f; --text-dark: #0a0a0a; }
        body { font-family: 'Cairo', sans-serif; margin: 0; }
        .custom-header {
            background: #ffb7db;
            border-bottom: 2px solid #ffb7db;
            padding: 10px 0;
            position: sticky;
            top: 0;
            z-index: 9999;
        }
        .nav-wrapper {
            display: flex;
            flex-direction: row-reverse; 
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 30px;
        }
        .logo-box img {
            height: 90px; width: 90px; border-radius: 50%;
            object-fit: cover; border: 3px solid white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .nav-menu { display: flex; gap: 25px; list-style: none; margin: 0; padding: 0; }
        .nav-link { text-decoration: none; color: var(--text-dark); font-size: 1.1rem; font-weight: 700; transition: 0.3s; }
        .nav-link:hover { color: var(--main-pink); }
        @media (max-width: 768px) { .nav-wrapper { flex-direction: column; gap: 15px; } }
    </style>
</head>
<body>
<header class="custom-header">
    <div class="nav-wrapper">
        <div class="logo-box">
            <a href="index.php"><img src="images/logo.jpeg" alt="Logo"></a>
        </div>
        <ul class="nav-menu">
            <li><a href="index.php" class="nav-link">الرئيسية</a></li>
            <li><a href="products.php" class="nav-link">المنتجات</a></li>
            <li><a href="about.php" class="nav-link">من نحن</a></li> 
            <li><a href="contact.php" class="nav-link">تواصل معنا</a></li>
            <li><a href="cart.php" class="nav-link">السلة 🛒</a></li>
        </ul>
    </div>
</header>