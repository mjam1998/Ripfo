<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سامانه کارزهای پژوهشی</title>

    <!-- Bootstrap RTL CSS -->
    <link href="{{asset('front/aaset/bootstrap.rtl.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('front/aaset/bootstrap-icons.css')}}">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('front/aaset/style.css')}}">
</head>

<body>

<!-- Header -->
<header class="top-header">
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container-fluid"> <!-- دکمه همبرگری -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span> </button> <!-- منو -->
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 header-links">
                    <li class="nav-item"><a class="nav-link" href="#">صفحه اصلی</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">اطلاعات سامانه</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">مرور</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">راهنمای نویسندگان</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">ارسال مقاله</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">داوران</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">تماس با ما</a></li>
                </ul> <!-- اکشن‌ها -->
                <div class="header-actions d-flex align-items-center">
                    <button class="btn btn-light btn-sm me-2">ENGLISH</button>
                    <a href="{{route('login')}}" class="nav-link text-white">ورود به سامانه</a>
                </div>
            </div>
        </div>
    </nav>
</header>

@yield('content')

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <!-- Header Text -->
        <div class="footer-header">
            <div class="decorative-line"></div>
            <h2 class="footer-title">در مسیر حکمرانی هوشمند، برای فردایی مطمئن</h2>
            <div class="decorative-line"></div>
        </div>

        <!-- Main Footer Content -->
        <div class="row footer-content " style="margin-top: 100px;">
            <!-- Left Column: Logo & Description -->
            <div class="col-lg-3 mb-4">
                <div class="footer-logo-section">
                    <img src="{{asset('front/aaset/img/logo-footer.png')}}" alt="لوگو" class="footer-logo">
                    <p class="footer-description">
                        بالاترین مرجع سیاستگذاری و نظارت بر صندوق‌های بیمه‌ای وابسته به دولت است.
                        این هیات برای ایجاد مدیریت یکپارچه، افزایش شفافیت و کنترل بهتر منابع
                        بیمه‌شدگان تشکیل شده است. اعضای آن با حکم وزیر کار منصوب می‌شوند و بر
                        بودجه، برنامه‌ریزی و عملکرد صندوق‌ها نظارت می‌کنند. وظیفه اصلی هیات امنا
                        تعیین خط‌مشی‌های کلان، تصویب بودجه و نظارت بر اجرای صحیح تعهدات بیمه‌ای و
                        بازنشستگی است. به‌طور کلی، این هیات تضمین‌کننده مدیریت صحیح و پایدار
                        منابع و حقوق بیمه‌شدگان و بازنشستگان است.
                    </p>
                </div>
            </div>

            <!-- Middle Column: Important Links -->
            <div class="col-lg-3 mb-4 " style="padding-right: 50px;">
                <div class="footer-links">
                    <h3 class="links-title">لینک های مهم</h3>
                    <ul class="links-list">
                        <li><a href="#">رهبر معظم انقلاب اسلامی</a></li>
                        <li><a href="#">پایگاه اطلاع رسانی ریاست جمهور</a></li>
                        <li><a href="#">پایگاه اطلاع رسانی دولت</a></li>
                        <li><a href="#">پایگاه ملی اطلاع رسانی قوانین و</a></li>
                        <li><a href="#">مقررات کشور</a></li>
                        <li><a href="#">مرکز پژوهش‌های مجلس</a></li>
                    </ul>
                </div>
            </div>

            <!-- Right Column: Fund Links & Quick Access -->
            <div class="col-lg-3 mb-4">
                <div class="footer-links">
                    <h3 class="links-title">ارتباط با صندوق ها</h3>
                    <ul class="links-list">
                        <li><a href="#">درباره ما</a></li>
                        <li><a href="#">اخبار</a></li>
                        <li><a href="#">ارتباط با ما</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 mb-5">
                <div class="footer-links ">
                    <h3 class="links-title">دسترسی سریع</h3>
                    <ul class="links-list">
                        <li><a href="#">درباره ما</a></li>
                        <li><a href="#">اخبار</a></li>
                        <li><a href="#">ارتباط با ما</a></li>

                    </ul>
                </div>
            </div>
        </div>

        <!-- Contact Bar -->
        <div class="contact-bar">
            <div class="contact-item">
                <svg class="contact-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                    <circle cx="12" cy="10" r="3"></circle>
                </svg>
                <span>تهران ، خیابان ستارخان ، کوچه سوم ، پلاک 42</span>
            </div>

            <div class="contact-item">
                <svg class="contact-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                    <polyline points="22,6 12,13 2,6"></polyline>
                </svg>
                <span>ripfo@info.com</span>
            </div>

            <div class="contact-item">
                <svg class="contact-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                </svg>
                <span>021-66948188</span>
            </div>
        </div>

        <!-- Copyright -->
        <div class="copyright">
            <p>تمامی حقوق مادی و معنوی سایت برای طراح محفوظ می باشد.</p>
        </div>

        <!-- Social Media Icons -->
        <div class="social-icons">
            <a href="#" class="social-link">
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <path d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4H7.6m9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8 1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5 5 5 0 0 1-5 5 5 5 0 0 1-5-5 5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3 3 3 0 0 0 3 3 3 3 0 0 0 3-3 3 3 0 0 0-3-3z"/>
                </svg>
            </a>

            <a href="#" class="social-link">
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
            </a>

            <a href="#" class="social-link">
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <path d="M9.78 18.65l.28-4.23 7.68-6.92c.34-.31-.07-.46-.52-.19L7.74 13.3 3.64 12c-.88-.25-.89-.86.2-1.3l15.97-6.16c.73-.33 1.43.18 1.15 1.3l-2.72 12.81c-.19.91-.74 1.13-1.5.71L12.6 16.3l-1.99 1.93c-.23.23-.42.42-.83.42z"/>
                </svg>
            </a>

            <a href="#" class="social-link">
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <circle cx="12" cy="12" r="10"/>
                    <path fill="#000080" d="M12 2a10 10 0 0 1 10 10 10 10 0 0 1-10 10A10 10 0 0 1 2 12 10 10 0 0 1 12 2m0 2a8 8 0 0 0-8 8 8 8 0 0 0 8 8 8 8 0 0 0 8-8 8 8 0 0 0-8-8m-3 5h2v2h2V9h2v2h-2v2h2v2h-2v2h-2v-2H9v2H7v-2h2v-2H7v-2h2V9z"/>
                </svg>
            </a>
        </div>
    </div>
</footer>

<!-- <footer class="site-footer py-4">
  <div class="container text-center">


  </div>
</footer> -->

<!-- Bootstrap JS -->
<script src="{{asset('front/aaset/bootstrap.bundle.min.js')}}"></script>

<!-- Custom JS -->
<script src="{{asset('front/aaset/script.js')}}"></script>

</body>

</html>
