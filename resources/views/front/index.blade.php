@extends('front.layot.master')

@section('content')
    <!-- Main Header with Logo -->
    <div class="main-header">

        <div class="container-fluid">
            <div class="row align-items-center py-5">
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <h1 class="site-title">سامانه گزارش های پژوهشی</h1>
                    <p class="site-subtitle">دبیرخانه هیئت امنای سازمان تامین اجتماعی و صندوق های تابعه </p>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-2 ">
                    <img src="{{asset('front/aaset/img/logo.png')}}" class="img-fluid" style="height: 200px;">
                </div>
                <div class="col-md-2"></div>
                <div class="row justify-content-center align-items-center mb-4">

                    <!-- دکمه ورود -->
                    <div class="col-auto">
                        <a href="{{route('login')}}" class="btn side-btn"
                           style="background-color: #a89e45; color: white;  border-radius: 50px; font-size: 20px;">ورود به سامانه</a>
                    </div>

                    <!-- جستجو -->
                    <div class="col-lg-6 col-md-8 col-12 mt-3 mt-md-0">
                        <div class="search-box">
                            <input type="text" class="form-control" placeholder="عنوان مقاله یا نویسنده را اینجا جستجو کنید">
                            <button class="btn btn-search" style="font-size: 20px;">جستجو</button>
                        </div>
                    </div>



                </div>

            </div>

        </div>







    </div>







    <!-- Main Content -->
    <section class="main-content py-5">
        <div class="container">
            <div class="row">
                <!-- Right Sidebar -->
                <div class="col-lg-2 mb-4 " style="padding-inline: 0;">
                    <div class="sidebar ">
                        <a class="btn side-btn"
                           style="background-color: #a89e45; color: white; width: 100%; border-radius: 50px;">مقالات آماده انتشار</a>
                        <a class="btn side-btn"
                           style="background-color: #a89e45; color: white; width: 100%; border-radius: 50px; margin-top: 10px;">
                            شماره جاری</a>
                        <div class="accordion-wrapper" style="margin-top: 10px;">
                            <h3 class="accordion-title">شماره‌های پیشین نشریه</h3>
                            <!-- اکاردون-->
                            <div class="accordion" id="issuesAccordion">
                                <!-- دوره 12 (1404) -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse12">
                                            <span class="plus-icon">+</span>
                                            دوره 12 (1404)
                                        </button>
                                    </h2>
                                    <div id="collapse12" class="accordion-collapse collapse" data-bs-parent="#issuesAccordion">
                                        <div class="accordion-body">
                                            <ul class="issue-list">
                                                <li><a href="#issue-12-4">📄 شماره 4</a></li>
                                                <li><a href="#issue-12-3">📄 شماره 3</a></li>
                                                <li><a href="#issue-12-2">📄 شماره 2</a></li>
                                                <li><a href="#issue-12-1">📄 شماره 1</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- دوره 11 (1403) -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse11">
                                            <span class="minus-icon">−</span>
                                            دوره 11 (1403)
                                        </button>
                                    </h2>
                                    <div id="collapse11" class="accordion-collapse collapse show" data-bs-parent="#issuesAccordion">
                                        <div class="accordion-body">
                                            <ul class="issue-list">
                                                <li><a href="#issue-11-4">📄 شماره 4</a></li>
                                                <li><a href="#issue-11-3">📄 شماره 3</a></li>
                                                <li><a href="#issue-11-2">📄 شماره 2</a></li>
                                                <li><a href="#issue-11-1">📄 شماره 1</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- دوره 10 (1402) -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse10">
                                            <span class="plus-icon">+</span>
                                            دوره 10 (1402)
                                        </button>
                                    </h2>
                                    <div id="collapse10" class="accordion-collapse collapse" data-bs-parent="#issuesAccordion">
                                        <div class="accordion-body">
                                            <ul class="issue-list">
                                                <li><a href="#issue-10-4">📄 شماره 4</a></li>
                                                <li><a href="#issue-10-3">📄 شماره 3</a></li>
                                                <li><a href="#issue-10-2">📄 شماره 2</a></li>
                                                <li><a href="#issue-10-1">📄 شماره 1</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- دوره 9 (1401) -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse9">
                                            <span class="plus-icon">+</span>
                                            دوره 9 (1401)
                                        </button>
                                    </h2>
                                    <div id="collapse9" class="accordion-collapse collapse" data-bs-parent="#issuesAccordion">
                                        <div class="accordion-body">
                                            <ul class="issue-list">
                                                <li><a href="#issue-9-4">📄 شماره 4</a></li>
                                                <li><a href="#issue-9-3">📄 شماره 3</a></li>
                                                <li><a href="#issue-9-2">📄 شماره 2</a></li>
                                                <li><a href="#issue-9-1">📄 شماره 1</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- دوره 8 (1400) -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse8">
                                            <span class="plus-icon">+</span>
                                            دوره 8 (1400)
                                        </button>
                                    </h2>
                                    <div id="collapse8" class="accordion-collapse collapse" data-bs-parent="#issuesAccordion">
                                        <div class="accordion-body">
                                            <ul class="issue-list">
                                                <li><a href="#issue-8-4">📄 شماره 4</a></li>
                                                <li><a href="#issue-8-3">📄 شماره 3</a></li>
                                                <li><a href="#issue-8-2">📄 شماره 2</a></li>
                                                <li><a href="#issue-8-1">📄 شماره 1</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- دوره 7 (1399) -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse7">
                                            <span class="plus-icon">+</span>
                                            دوره 7 (1399)
                                        </button>
                                    </h2>
                                    <div id="collapse7" class="accordion-collapse collapse" data-bs-parent="#issuesAccordion">
                                        <div class="accordion-body">
                                            <ul class="issue-list">
                                                <li><a href="#issue-7-4">📄 شماره 4</a></li>
                                                <li><a href="#issue-7-3">📄 شماره 3</a></li>
                                                <li><a href="#issue-7-2">📄 شماره 2</a></li>
                                                <li><a href="#issue-7-1">📄 شماره 1</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- دوره 6 (1398) -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse6">
                                            <span class="plus-icon">+</span>
                                            دوره 6 (1398)
                                        </button>
                                    </h2>
                                    <div id="collapse6" class="accordion-collapse collapse" data-bs-parent="#issuesAccordion">
                                        <div class="accordion-body">
                                            <ul class="issue-list">
                                                <li><a href="#issue-6-4">📄 شماره 4</a></li>
                                                <li><a href="#issue-6-3">📄 شماره 3</a></li>
                                                <li><a href="#issue-6-2">📄 شماره 2</a></li>
                                                <li><a href="#issue-6-1">📄 شماره 1</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- دوره 5 (1397) -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse5">
                                            <span class="plus-icon">+</span>
                                            دوره 5 (1397)
                                        </button>
                                    </h2>
                                    <div id="collapse5" class="accordion-collapse collapse" data-bs-parent="#issuesAccordion">
                                        <div class="accordion-body">
                                            <ul class="issue-list">
                                                <li><a href="#issue-5-4">📄 شماره 4</a></li>
                                                <li><a href="#issue-5-3">📄 شماره 3</a></li>
                                                <li><a href="#issue-5-2">📄 شماره 2</a></li>
                                                <li><a href="#issue-5-1">📄 شماره 1</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- دوره 4 (1396) -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse4">
                                            <span class="plus-icon">+</span>
                                            دوره 4 (1396)
                                        </button>
                                    </h2>
                                    <div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#issuesAccordion">
                                        <div class="accordion-body">
                                            <ul class="issue-list">
                                                <li><a href="#issue-4-4">📄 شماره 4</a></li>
                                                <li><a href="#issue-4-3">📄 شماره 3</a></li>
                                                <li><a href="#issue-4-2">📄 شماره 2</a></li>
                                                <li><a href="#issue-4-1">📄 شماره 1</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- دوره 3 (1395) -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse3">
                                            <span class="plus-icon">+</span>
                                            دوره 3 (1395)
                                        </button>
                                    </h2>
                                    <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#issuesAccordion">
                                        <div class="accordion-body">
                                            <ul class="issue-list">
                                                <li><a href="#issue-3-4">📄 شماره 4</a></li>
                                                <li><a href="#issue-3-3">📄 شماره 3</a></li>
                                                <li><a href="#issue-3-2">📄 شماره 2</a></li>
                                                <li><a href="#issue-3-1">📄 شماره 1</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--فهرست-->



                        </div>

                    </div>
                    <div class="sidebar" style="margin-top: 20px;">
                        <div class="stats-grid">
                            <div class="stat-card">
                                <span class="stat-number">1189.802</span>
                                <span class="stat-label">تعداد مشاهده مقاله</span>
                            </div>

                            <div class="stat-card">
                                <span class="stat-number">755.883</span>
                                <span class="stat-label">تعداد دانلود اصل فایل</span>
                            </div>

                            <div class="stat-card">
                                <span class="stat-number">1610.02</span>
                                <span class="stat-label">نسبت نقل به مقاله</span>
                            </div>

                            <div class="stat-card">
                                <span class="stat-number">1022.85</span>
                                <span class="stat-label">تعداد دانلود نسبت به مقاله</span>
                            </div>

                            <div class="stat-card">
                                <span class="stat-number">1452</span>
                                <span class="stat-label">تعداد مقالات صادر شده</span>
                            </div>

                            <div class="stat-card">
                                <span class="stat-number">902</span>
                                <span class="stat-label">تعداد مقالات صادر شده</span>
                            </div>

                            <div class="stat-card">
                                <span class="stat-number">62</span>
                                <span class="stat-label">تعداد مقالات صادر شده</span>
                            </div>

                            <div class="stat-card">
                                <span class="stat-number">252</span>
                                <span class="stat-label">تعداد مقالات صادر شده</span>
                            </div>

                            <div class="stat-card">
                                <span class="stat-number">17</span>
                                <span class="stat-label">تعداد مقالات صادر شده</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-lg-8">
                    <div class="intro-section mb-5">
                        <h2 class="section-title" style="color: #a89e45;font-size: 30px;">معرفی سامانه</h2>
                        <p class="intro-text">
                            به موجب قانون مطبوعات، پروانه انتشار نشریه پژوهش‌های اقتصادی ایران به زبان فارسی و انگلیسی به شماره
                            ۱۴۴/۳۵۳۴۸ مورخ ۱۳۸۶/۰۶/۰۹ از سوی وزارت فرهنگ و ارشاد اسلامی ثبت و صادر شده است. این نشریه با دریافت رتبه
                            علمی برتر کشور حائز شرایط دریافت وجوه پژوهشی شناخته شده است و دارای ضریب IF از پایگاه استنادی جهان اسلام
                            (ISC) می‌باشد. این مجله تحت نظارت کمیسیون بررسی نشریات علمی کشور حائز شرایط دریافت وجوه پژوهشی بنا به
                            بخشنامه شماره ۱۳۸۱/۴/۱۸ مورخ ۱۶/۲/۱۹۱۰ صادر شده شمارهٔ ۱۳۸۰ تایید به شماره ۱۲/۹۱۰/۸۸ مورخ ۲۵/۱۱/۱۳۸۰
                            می‌باشد.
                        </p>
                        <p class="intro-text">
                            نشریه پژوهش‌های اقتصادی ایران یک نشریه با داوری بسته و دو‌سو‌ناشناس و با دسترسی آزاد است که از سوی دانشگاه
                            علامه طباطبائی به عنوان دانشگاه پیشرو در علوم انسانی و اجتماعی در ایران منتشر می‌شود. این نشریه به منظور
                            فراهم نمودن محیط فکری برای پژوهشگران ملی و بین المللی با تمرکز بر مباحث اقتصادی پایه گذاری شده است. این
                            نشریه در پاسخ به پیشرفت‌های صورت گرفته در حوزه اقتصادی انتشار یافته است و از انتشار مقالات با کیفیت که
                            یافته‌های مرتبط با موضوعات مهم اقتصادی را گزارش می‌دهند است.
                        </p>
                    </div>

                    <!-- Articles Section -->
                    <div class="articles-section">
                        <!-- Navigation Tabs -->
                        <div class="tabs-container">
                            <button class="tab-button active" data-tab="current">دوره جاری</button>
                            <button class="tab-button" data-tab="ready">آماده انتشار</button>
                            <button class="tab-button" data-tab="process">پر بازدید</button>
                        </div>

                        <!-- Current Issue Tab Content -->
                        <div class="tab-content active" id="current">
                            <div class="article-card">
                                <div class="article-badges">
                                    <span class="badge badge-research">مقاله پژوهشی</span>
                                    <span class="badge badge-accepted">اعتماد مالی</span>
                                </div>
                                <h3 class="article-title">بررسی اثر احتمال نکول تسهیلات اعطایی در بانک ملی: مقایسه رویکردهای یادگیری
                                    ماشین و اقتصادسنجی</h3>
                                <p class="article-authors">رضا طالبلو، علی طریقی کاشانی، یوسفا صیادی</p>
                                <p class="article-meta">دوره 30، شماره 103، تیر 1404، صفحه 41-1</p>
                                <a href="#" class="article-link">https://doi.org/10.22054/ijer.2025.84878.1350</a>
                                <p class="article-abstract">چکیده: در این پژوهش، به بررسی عوامل مؤثر بر کنش مشاعات از فرود یکانه‌های
                                    تجاری با استفاده از سرمایه‌گذاری راهبردی پنهان درگاه یک مطالعه شبیه‌سازی شده است...</p>
                                <div class="article-footer">
                                    <span class="article-views">2.23 M مشاهده مقاله</span>
                                    <a href="#" class="article-download">اصل مقاله</a>
                                </div>
                            </div>

                            <div class="article-card">
                                <div class="article-badges">
                                    <span class="badge badge-research">مقاله پژوهشی</span>
                                    <span class="badge badge-international">تجارت بین‌الملل</span>
                                </div>
                                <h3 class="article-title">اندازه بازار و استخدام استراتژیک: بررسی کار تحقیق توسعه به‌عنوان مانع ورود و
                                    قدرت فروش طراحی</h3>
                                <p class="article-authors">علی طریقی، سمیرا علیزاده، داوید بهرامی، سمیره شکیب‌حسینی</p>
                                <p class="article-meta">دوره 30، شماره 103، تیر 1404، صفحه 69-42</p>
                                <a href="#" class="article-link">https://doi.org/10.22054/ijer.2025.85552.1357</a>
                                <p class="article-abstract">چکیده: در این پژوهش، به بررسی عوامل مؤثر بر کنش مشاعات از فرود یکانه‌های
                                    تجاری با استفاده از سرمایه‌گذاری راهبردی پنهان در گاه یک مطالعه...</p>
                                <div class="article-footer">
                                    <span class="article-views">2.29 M مشاهده مقاله</span>
                                    <a href="#" class="article-download">اصل مقاله</a>
                                </div>
                            </div>

                            <div class="article-card">
                                <div class="article-badges">
                                    <span class="badge badge-research">مقاله پژوهشی</span>
                                </div>
                                <h3 class="article-title">بررسی اثر سطح تقارظی خیر حداکثر سود علیرینی مشاعی و مقایسه آن در کشورهای
                                    توسعه‌یافته و درحال‌توسعه</h3>
                                <p class="article-authors">سجیمه حسن الدین، فرشاد مومنی، علیرضا کیانی‌شمسی</p>
                                <p class="article-meta">دوره 30، شماره 103، تیر 1404، صفحه 100-70</p>
                                <a href="#" class="article-link">https://doi.org/10.22054/ijer.2024.77348.1248</a>
                                <p class="article-abstract">چکیده: این مقاله با هدف بررسی اثر سطح تقارظی خیر بر رشد اقتصادی و
                                    سرمایه‌گذاری و مقایسه آن در کشورهای توسعه‌یافته و درحال‌توسعه...</p>
                                <div class="article-footer">
                                    <span class="article-views">2.16 M مشاهده مقاله</span>
                                    <a href="#" class="article-download">اصل مقاله</a>
                                </div>
                            </div>

                            <div class="article-card">
                                <div class="article-badges">
                                    <span class="badge badge-research">مقاله پژوهشی</span>
                                    <span class="badge badge-accepted">اقتصاد مالی</span>
                                </div>
                                <h3 class="article-title">بررسی احتمال نکول تسهیلات اعطایی در بانک ملی: مقایسه رویکردهای یادگیری ماشین و
                                    اقتصادسنجی</h3>
                                <p class="article-authors">رضا طالبلو، علی طریقی کاشانی، یوسفا صیادی</p>
                                <p class="article-meta">دوره 30، شماره 103، تیر 1404، صفحه 41-1</p>
                                <a href="#" class="article-link">https://doi.org/10.22054/ijer.2025.84878.1350</a>
                                <div class="article-footer">
                                    <span class="article-views">2.10 M مشاهده مقاله</span>
                                    <a href="#" class="article-download">اصل مقاله</a>
                                </div>
                            </div>

                            <div class="article-card">
                                <div class="article-badges">
                                    <span class="badge badge-research">مقاله پژوهشی</span>
                                </div>
                                <h3 class="article-title">تحلیل عوامل مؤثر بر توسعه اقتصادی منطقه‌ای با رویکرد اقتصادسنجی فضایی</h3>
                                <p class="article-authors">محمد رضایی، فاطمه احمدی</p>
                                <p class="article-meta">دوره 30، شماره 103، تیر 1404، صفحه 130-101</p>
                                <a href="#" class="article-link">https://doi.org/10.22054/ijer.2025.84879.1351</a>
                                <div class="article-footer">
                                    <span class="article-views">1.95 M مشاهده مقاله</span>
                                    <a href="#" class="article-download">اصل مقاله</a>
                                </div>
                            </div>
                        </div>

                        <!-- Ready for Publication Tab Content -->
                        <div class="tab-content" id="ready">
                            <div class="article-card">
                                <div class="article-badges">
                                    <span class="badge badge-research">مقاله پژوهشی</span>
                                </div>
                                <h3 class="article-title">تحلیل تأثیر سیاست‌های پولی بر بازار سرمایه ایران</h3>
                                <p class="article-authors">احمد محمدی، سارا کریمی</p>
                                <p class="article-meta">دوره 30، شماره 104، مهر 1404</p>
                                <div class="article-footer">
                                    <span class="article-views">1.2 M مشاهده مقاله</span>
                                    <a href="#" class="article-download">اصل مقاله</a>
                                </div>
                            </div>
                            <!-- Add more article cards here -->
                        </div>

                        <!-- Most Viewed Tab Content -->
                        <div class="tab-content" id="process">
                            <div class="article-card">
                                <div class="article-badges">
                                    <span class="badge badge-research">مقاله پژوهشی</span>
                                </div>
                                <h3 class="article-title">بررسی رابطه تورم و رشد اقتصادی در ایران</h3>
                                <p class="article-authors">رضا احمدی، مریم رضایی</p>
                                <p class="article-meta">دوره 29، شماره 102، فروردین 1404</p>
                                <div class="article-footer">
                                    <span class="article-views">5.8 M مشاهده مقاله</span>
                                    <a href="#" class="article-download">اصل مقاله</a>
                                </div>
                            </div>
                            <!-- Add more article cards here -->
                        </div>
                    </div>

                    <div class="sub-sec">
                        <!-- New Buttons Section -->
                        <div class="action-buttons-section mb-4">
                            <div class="row justify-content-center g-3">
                                <div class="col-lg-3 col-md-6">
                                    <button class="action-btn">
                     <span style="font-size: 30px; color: #0039ac;">
                      <i class="bi bi-bar-chart-line" ></i>
                     </span>
                                        <span>آمار و اطلاعات</span>
                                    </button>
                                </div>

                                <div class="col-lg-3 col-md-6">
                                    <button class="action-btn">
                    <span style="font-size: 30px; color: #0039ac;">
                      <i class="bi bi-building"></i>
                    </span>

                                        <span style="font-size: small;">شورای عالی رفاه و تامین اجتماعی</span>
                                    </button>
                                </div>

                                <div class="col-lg-3 col-md-6">
                                    <button class="action-btn">

                    <span style="font-size: 30px; color: #0039ac;">
                      <i class="bi bi-book"></i>
                    </span>
                                        <span>گزارش های ارزیابی</span>
                                    </button>
                                </div>

                                <div class="col-lg-3 col-md-6">
                                    <button class="action-btn">
                    <span style="font-size: 30px; color: #0039ac;">
                      <i class="bi bi-buildings"></i>
                    </span>

                                        <span>معرفی صندوق ها</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Books Section with Hover Effect -->
                        <div class="books-section mb-5">
                            <h2 class="section-title text-center mb-4">انتشارات پژوهشی</h2>
                            <div class="row justify-content-center">
                                <div class="col-md-4 mb-4">
                                    <div class="book-card" data-bg-color="#4CAF50">
                                        <div class="book-image">
                                            <img src="{{asset('front/aaset/img/banner-left.jpg')}}" alt="Book 1"
                                                 class="img-fluid tilted">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <div class="book-card" data-bg-color="#2196F3">
                                        <div class="book-image">
                                            <img src="{{asset('front/aaset/img/banner-left.jpg')}}" alt="Book 1"
                                                 class="img-fluid tilted">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <div class="book-card" data-bg-color="#FF9800">
                                        <div class="book-image">
                                            <img src="{{asset('front/aaset/img/banner-left.jpg')}}" alt="Book 1"
                                                 class="img-fluid tilted">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Word Cloud -->


                    <div class="word-cloud-container">
                        <h4 class="word-cloud-title">
                            <span>ابر واژگان</span>
                        </h4>
                        <div id="wordcloud" class="word-cloud-wrapper">
                            <svg id="wordcloud-svg" width="100%" viewBox="0 0 1000 400"></svg>
                        </div>
                        <div class="word-cloud-loading" id="loading">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">در حال بارگذاری...</span>
                            </div>
                        </div>
                    </div>


                    <!-- <div class="wordcloud-section text-center">
                      <div class="word-cloud">
                        <span class="word word-large">پژوهش</span>
                        <span class="word word-medium">پژوهشگر</span>
                        <span class="word word-small">آموزش</span>
                        <span class="word word-large">دانش</span>
                        <span class="word word-medium">علم</span>
                        <span class="word word-xlarge">پژوهشی</span>
                        <span class="word word-small">کار</span>
                        <span class="word word-large">سیستم</span>
                        <span class="word word-medium">مدیریت</span>
                        <span class="word word-small">تحقیق</span>
                        <span class="word word-large">دانشگاه</span>
                        <span class="word word-medium">مقاله</span>
                        <span class="word word-xlarge">تحلیل</span>
                        <span class="word word-small">داده</span>
                        <span class="word word-medium">نوآوری</span>
                        <span class="word word-large">توسعه</span>

                      </div>
                    </div> -->

                </div>

                <div class="col-lg-2 mb-4" style="padding-inline: 0;">
                    <div class="sidebar">
                        <a>
                            <img src="{{asset('front/aaset/img/banner-left.jpg')}}" class="img-fluid">
                        </a>

                    </div>
                    <div class="sidebar" style="margin-top: 10px;">
                        <div class="info-sidebar">
                            <div class="info-section">
                                <h3 class="section-title" style="font-size: 15px; color: black;">صاحب امتیاز:</h3>
                                <p class="section-content">دانشگاه علامه طباطبائی</p>
                            </div>

                            <div class="info-section">
                                <h3 class="section-title" style="font-size: 15px; color: black;">مدیر مسئول:</h3>
                                <p class="section-content">تیمور محمدی</p>
                            </div>

                            <div class="info-section">
                                <h3 class="section-title" style="font-size: 15px; color: black;">سردبیر:</h3>
                                <p class="section-content">علی اصغر بانوئی</p>
                            </div>

                            <div class="info-section">
                                <h3 class="section-title" style="font-size: 15px; color: black;">دبیر تخصصی:</h3>
                                <p class="section-content">رضا طالبلو</p>
                            </div>

                            <div class="info-divider"></div>

                            <div class="info-section">
                                <h3 class="section-title" style="font-size: 15px; color: black;">دوره انتشار: فصلنامه</h3>
                                <p class="section-content">شاپا چاپی: 0728-1726</p>
                                <p class="section-content">شاپا الکترونیکی: 6445-2476</p>
                            </div>

                            <div class="info-divider"></div>

                            <div class="info-section">
                                <h3 class="section-title-large">بانک‌ها و نمایه نامه ها</h3>
                            </div>

                            <div class="info-section">
                                <p class="section-content">وزارت علوم، تحقیقات و فناوری</p>
                                <p class="section-content">پایگاه استنادی علوم جهان اسلام(ISC)</p>
                                <p class="section-content">گوگل اسکالر</p>
                                <p class="section-content">مرکز منطقه ای اطلاع رسانی علوم و فناوری</p>
                                <p class="section-content">آکادمیا</p>
                                <p class="section-content">DOAJ</p>
                                <p class="section-content">EconLit</p>
                                <p class="section-content">لینکدین</p>
                                <p class="section-content">...</p>
                            </div>
                        </div>

                    </div>
                    <div class="sidebar" style="margin-top: 10px;">

                        <img src="{{asset('front/aaset/img/vezarat-olom.jpg')}}" class="img-fluid" style="width: 100%;">
                        <p style="margin-top: 5px;"> <a href="#" style="font-size: small; ">نشریه در وزارت علوم و تحقیقات فناوری</a>
                        </p>

                    </div>
                    <div class="sidebar" style="margin-top: 10px;">
                        <img src="{{asset('front/aaset/img/vezarat-farhang.jpg')}}" class="img-fluid" style="width: 100%;">
                        <p style="margin-top: 5px;"><a href="#" style="font-size: small; ">نشریه در وزارت فرهنگ و ارشاد اسلامی</a>
                        </p>
                    </div>

                    <div class="sidebar" style="margin-top: 10px;">
                        <img src="{{asset('front/aaset/img/open-access.jpg')}}" class="img-fluid" style="width: 100%;">
                        <p style="margin-top: 5px;"><a href="#" style="font-size: small; ">Open Access</a>
                        </p>
                    </div>

                    <div class="sidebar" style="margin-top: 10px;">
                        <img src="{{asset('front/aaset/img/road.jpg')}}" class="img-fluid" style="width: 100%;">
                        <p style="margin-top: 5px;"><a href="#" style="font-size: small; ">Road</a>
                        </p>
                    </div>

                    <div class="sidebar" style="margin-top: 10px;">
                        <img src="{{asset('front/aaset/img/isnn.jpg')}}" class="img-fluid" style="width: 100%;">
                        <p style="margin-top: 5px;"><a href="#" style="font-size: small; ">Isnn</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        // داده‌های نمونه (شبیه‌سازی دیتابیس)
        const sampleWords = [
            { text: "رشد اقتصادی", weight: 100 },
            { text: "ایران", weight: 95 },
            { text: "تورم", weight: 65 },
            { text: "اقتصاد ایران", weight: 55 },
            { text: "سرمایه انسانی", weight: 50 },
            { text: "توسعه مالی", weight: 48 },
            { text: "نرخ ارز", weight: 45 },
            { text: "کارایی", weight: 42 },
            { text: "داده‌های تابلویی", weight: 40 },
            { text: "سیاست پولی", weight: 38 },
            { text: "اشتغال", weight: 35 },
            { text: "توزیع درآمد", weight: 35 },
            { text: "صادرات", weight: 33 },
            { text: "نقدینگی", weight: 32 },
            { text: "ریسک", weight: 30 },
            { text: "نرخ بهره", weight: 30 },
            { text: "خوزستان", weight: 28 },
            { text: "بازار سهام", weight: 28 },
            { text: "نرخ تورم", weight: 27 },
            { text: "آموزش", weight: 26 },
            { text: "فقر", weight: 25 },
            { text: "نوآوری", weight: 24 },
            { text: "پیش‌بینی", weight: 23 },
            { text: "صنعت", weight: 22 },
            { text: "بهره‌وری", weight: 21 },
            { text: "اندازه دولت", weight: 20 },
            { text: "مصرف انرژی", weight: 19 },
            { text: "ضریب جینی", weight: 18 },
            { text: "قیمت نفت", weight: 17 },
            { text: "سرمایه‌گذاری", weight: 16 }
        ];

        // تنظیمات
        let config = {
            width: 1000,
            height: 400,
            centerX: 500,
            centerY: 200,
            minFontSize: 12,
            maxFontSize: 50,
            allowRotation: true,
            colors: ['color-1', 'color-2', 'color-3', 'color-4', 'color-5', 'color-6', 'color-7', 'color-8']
        };

        // کلاس مدیریت ابر واژگان
        class WordCloud {
            constructor(words, containerId) {
                this.words = words;
                this.svg = document.getElementById(containerId);
                this.placedWords = [];
            }

            // محاسبه اندازه فونت
            calculateFontSize(weight) {
                const maxWeight = Math.max(...this.words.map(w => w.weight));
                const minWeight = Math.min(...this.words.map(w => w.weight));
                const range = maxWeight - minWeight;
                const normalized = (weight - minWeight) / range;
                return config.minFontSize + (normalized * (config.maxFontSize - config.minFontSize));
            }

            // انتخاب رنگ تصادفی
            getRandomColor() {
                return config.colors[Math.floor(Math.random() * config.colors.length)];
            }

            // انتخاب چرخش
            getRotation() {
                if (!config.allowRotation) return 0;
                return Math.random() > 0.6 ? -90 : 0;
            }

            // محاسبه ابعاد متن
            getTextDimensions(text, fontSize, rotation) {
                const tempText = document.createElementNS('http://www.w3.org/2000/svg', 'text');
                tempText.setAttribute('font-size', fontSize);
                tempText.setAttribute('font-family', 'Vazirmatn');
                tempText.textContent = text;
                this.svg.appendChild(tempText);

                const bbox = tempText.getBBox();
                this.svg.removeChild(tempText);

                if (rotation === -90 || rotation === 90) {
                    return { width: bbox.height, height: bbox.width };
                }
                return { width: bbox.width, height: bbox.height };
            }

            // بررسی تداخل
            checkCollision(x, y, width, height) {
                for (let placed of this.placedWords) {
                    if (!(x + width < placed.x ||
                        x > placed.x + placed.width ||
                        y + height < placed.y ||
                        y > placed.y + placed.height)) {
                        return true;
                    }
                }
                return false;
            }

            // پیدا کردن موقعیت مناسب
            findPosition(width, height) {
                const maxAttempts = 500;
                const spiralStep = 5;

                for (let i = 0; i < maxAttempts; i++) {
                    const angle = 0.1 * i;
                    const radius = spiralStep * angle;
                    const x = config.centerX + radius * Math.cos(angle) - width / 2;
                    const y = config.centerY + radius * Math.sin(angle) - height / 2;

                    if (!this.checkCollision(x, y, width, height)) {
                        return { x, y };
                    }
                }

                return null;
            }

            // رندر کردن
            render() {
                // پاک کردن SVG
                this.svg.innerHTML = '';
                this.placedWords = [];

                // مرتب‌سازی بر اساس وزن
                const sortedWords = [...this.words].sort((a, b) => b.weight - a.weight);

                sortedWords.forEach((word, index) => {
                    const fontSize = this.calculateFontSize(word.weight);
                    const rotation = this.getRotation();
                    const dimensions = this.getTextDimensions(word.text, fontSize, rotation);
                    const position = this.findPosition(dimensions.width, dimensions.height);

                    if (position) {
                        const textElement = document.createElementNS('http://www.w3.org/2000/svg', 'text');

                        textElement.setAttribute('x', position.x + dimensions.width / 2);
                        textElement.setAttribute('y', position.y + dimensions.height / 2);
                        textElement.setAttribute('text-anchor', 'middle');
                        textElement.setAttribute('dominant-baseline', 'middle');
                        textElement.setAttribute('font-size', fontSize);
                        textElement.setAttribute('font-family', 'Vazirmatn');
                        textElement.setAttribute('class', `word-cloud-text ${this.getRandomColor()}`);
                        textElement.setAttribute('transform', `rotate(${rotation}, ${position.x + dimensions.width / 2}, ${position.y + dimensions.height / 2})`);
                        textElement.style.opacity = '0.7';
                        textElement.style.animationDelay = `${index * 0.05}s`;

                        textElement.textContent = word.text;

                        // رویداد کلیک
                        textElement.addEventListener('click', () => {
                            alert(`کلمه: ${word.text}\nوزن: ${word.weight}`);
                        });

                        this.svg.appendChild(textElement);

                        this.placedWords.push({
                            x: position.x,
                            y: position.y,
                            width: dimensions.width,
                            height: dimensions.height
                        });
                    }
                });
            }

            // تنظیم viewBox برای ریسپانسیو
            updateViewBox() {
                this.svg.setAttribute('viewBox', `0 0 ${config.width} ${config.height}`);
            }
        }

        // تابع اصلی
        function initWordCloud() {
            const loading = document.getElementById('loading');
            loading.classList.remove('hidden');

            setTimeout(() => {
                const wordCloud = new WordCloud(sampleWords, 'wordcloud-svg');
                wordCloud.updateViewBox();
                wordCloud.render();

                loading.classList.add('hidden');
            }, 500);
        }

        // تولید مجدد
        function regenerateCloud() {
            initWordCloud();
        }

        // تغییر چرخش
        function toggleRotation() {
            config.allowRotation = !config.allowRotation;
            initWordCloud();
        }

        // ریسپانسیو
        function handleResize() {
            const container = document.querySelector('.word-cloud-wrapper');
            const containerWidth = container.offsetWidth;

            if (containerWidth < 600) {
                config.width = 600;
                config.height = 300;
                config.centerX = 300;
                config.centerY = 150;
                config.minFontSize = 10;
                config.maxFontSize = 30;
            } else if (containerWidth < 900) {
                config.width = 800;
                config.height = 350;
                config.centerX = 400;
                config.centerY = 175;
                config.minFontSize = 11;
                config.maxFontSize = 40;
            } else {
                config.width = 1000;
                config.height = 400;
                config.centerX = 500;
                config.centerY = 200;
                config.minFontSize = 12;
                config.maxFontSize = 50;
            }

            initWordCloud();
        }

        // اجرای اولیه
        document.addEventListener('DOMContentLoaded', () => {
            initWordCloud();

            let resizeTimer;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(handleResize, 250);
            });
        });

    </script>
@endsection
