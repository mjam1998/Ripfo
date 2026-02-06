<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل کاربری </title>
    <!-- Bootstrap RTL CSS -->
    <link href="{{asset('front/aaset/bootstrap.rtl.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('front/aaset/bootstrap-icons.css')}}">

    <link href="{{ asset('userpanel/css/app.css') }}" rel="stylesheet">
    <link href="{{asset('userpanel/choises/choices.min.css')}}" rel="stylesheet" />



    @livewireStyles

</head>
<body>

<!-- Overlay -->
<div class="overlay"></div>

<!-- Sidebar -->
<div class="sidebar" id="side1" >
    <div class="sidebar-header" >
        <div style="font-size: xxx-large; margin-left: 15px" ><i class="bi bi-person-circle"></i></div>
        <div class="user-info">
            <div class="user-name mt-3"><p style="font-size: small"></p></div>
            {{auth()->user()->name}}
            <div  class="user-status" style="font-size: medium;color: blue">
                @foreach(auth()->user()->roles as $role)
                    {{ \App\Enums\RolesName::fromRole($role->name) }} <br>
                @endforeach



            </div>
        </div>
    </div>

    <div class="nav-menu">
        <ul>

            <li><a href="{{route('writer.index')}}"  class=""><i class="bi bi-vector-pen"></i> داشبورد نویسندگی</a></li>
            <li><a href="{{route('writer.article')}}"  class=""><i class="bi bi-file-text"></i> ثبت مقاله جدید</a></li>
            <li class="has-submenu">
                <a href="javascript:void(0)" class="menu-toggle">
                    <i class="bi bi-layout-text-sidebar"></i> لیست مقالات نویسندگی

                </a>
                <ul class="submenu">

                    <li><a href="{{ route('writer.articles', \App\Enums\ArticleStatus::SendedReview->value) }}" style="font-size: small"><i class="bi bi-pencil-square"></i>  ارسال شده/در حال بررسی</a></li>
                    <li><a href="{{ route('writer.articles', \App\Enums\ArticleStatus::NeedReSend->value) }}" style="font-size: small"><i class="bi bi-pencil-square"></i>  نیازمند ارسال دوباره</a></li>
                    <li><a href="{{ route('writer.articles', \App\Enums\ArticleStatus::NeedEdit->value) }}" style="font-size: small"><i class="bi bi-pencil-square"></i>  نیازمند بازنگری</a></li>
                    <li><a href="{{ route('writer.articles', \App\Enums\ArticleStatus::EditedReview->value) }}" style="font-size: small"><i class="bi bi-pencil-square"></i>  بازنگری شده/درحال بررسی</a></li>
                    <li><a href="{{ route('writer.articles', \App\Enums\ArticleStatus::AcceptedFinalReview->value) }}" style="font-size: small"><i class="bi bi-pencil-square"></i>  پذیرفته شده بررسی نهایی </a></li>
                    <li><a href="{{ route('writer.articles', \App\Enums\ArticleStatus::Accepted->value) }}" style="font-size: small"><i class="bi bi-pencil-square"></i>  منتشر شده</a></li>
                    <li><a href="{{ route('writer.articles', \App\Enums\ArticleStatus::Rejected->value) }}" style="font-size: small"><i class="bi bi-pencil-square"></i>  رد شده</a></li>
                    <li><a href="{{ route('writer.articles', \App\Enums\ArticleStatus::Cancel->value) }}" style="font-size: small"><i class="bi bi-pencil-square"></i>  لغو شده توسط نویسنده</a></li>

                </ul>
            </li>
            <li><a href="{{route('writer.user.information')}}"  class=""><i class="bi bi-person-gear"></i> اطلاعات حساب کاربری</a></li>

            <li><a href="#"  class=""><i class="bi bi-box-arrow-right"></i> بازگشت به سایت</a></li>

        </ul>
    </div>

    <div class="sidebar-footer">
        <a href="{{route('writer.logout')}}" style="color: red;"><i class="bi bi-escape"></i> خروج از حساب کاربری</a>
    </div>
</div>

<!-- Main Content -->
<div class="main">







    <!-- Content Area -->


        @yield('content')





    <!-- Mobile Bottom Nav -->
    <div class="mobile-bottom-nav">
        <div class="nav-item active " id="nav-home" >
            <div class="p-2" >
                <a href="#"  onclick="openSidebarAndLoad('dashboard.html')"><i class="bi bi-list" style="font-size: xx-large;color: black"></i></a>
            </div>

        </div>
        <div class="nav-item" id="nav-profile">
            <div class="p-2" style="background-color: #131fde; border-radius: 10px; height: 100%; width: 80%;">
                <a href="#" style="text-decoration: none; font-size: medium; " ><img class="img-fluid" style="width: 30px; height: 30px; " src="{{asset('userpanel/img/plus-white.png')}}" alt=""></a>
            </div>
        </div>

        <div class="nav-item" id="nav-messages">
            <div class="p-2" style="background-color: #131fde; border-radius: 10px; height: 100%; width: 80%;">
                <a href="#" style="text-decoration: none; font-size: medium; " ><img class="img-fluid" style="width: 30px; height: 30px; " src="{{asset('userpanel/img/clipboard-white.png')}}" alt=""></a>
            </div>
        </div>
        <div class="nav-item" id="nav-messages">
            <div class="p-2" style="background-color: #131fde; border-radius: 10px; height: 100%; width: 80%;">
                <a href="#" style="text-decoration: none; font-size: medium; " ><img class="img-fluid" style="width: 30px; height: 30px; " src="{{asset('userpanel/img/person.png')}}" alt=""></a>
            </div>
        </div>

    </div>
    <!-- Bootstrap JS -->
    <script src="{{asset('front/aaset/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('userpanel/select2/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('userpanel/choises/choices.min.js')}}"></script>
    <script src="{{asset('userpanel/list/list.js')}}"></script>
    <script src="{{asset('userpanel/sweetalert/sweetalert.js')}}"></script>
    @livewireScripts
    <script>



        // باز کردن سایدبار + لود صفحه
        function openSidebarAndLoad(page) {
            document.querySelector('.sidebar').classList.add('active');
            document.querySelector('.overlay').classList.add('active');
            loadPage(page);
            updateActiveNavItem('nav-home');
        }

        // لود صفحه + بستن سایدبار
        function loadAndClose(page) {
            document.querySelector('.sidebar').classList.remove('active');
            document.querySelector('.overlay').classList.remove('active');
            loadPage(page);
            const map = { 'wishlist.html': 'nav-wishlist', 'new-ad.html': 'nav-add-ad', 'messages.html': 'nav-messages', 'profile.html': 'nav-profile' };
            updateActiveNavItem(map[page]);
        }

        // بروزرسانی active در نوار پایین
        function updateActiveNavItem(id) {
            document.querySelectorAll('.nav-item').forEach(el => el.classList.remove('active'));
            const active = document.getElementById(id);
            if (active) active.classList.add('active');
        }

        // بستن سایدبار با کلیک روی overlay
        document.querySelector('.overlay').addEventListener('click', () => {
            document.querySelector('.sidebar').classList.remove('active');
            document.querySelector('.overlay').classList.remove('active');
        });
        function copyText() {
            var text = document.getElementById('userUrl').innerText;
            navigator.clipboard.writeText(text);
            alert('کپی شد!');
            return false;
        }
        function downloadQR() {
            const a = document.createElement('a');
            a.href = 'qrcode.png';
            a.download = 'qrcode.png';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        }
// Toggle submenu
document.addEventListener('DOMContentLoaded', function() {
    const menuToggles = document.querySelectorAll('.menu-toggle');

    menuToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const parentLi = this.closest('.has-submenu');
            const wasActive = parentLi.classList.contains('active');

            // بستن همه submenuها
            document.querySelectorAll('.has-submenu').forEach(item => {
                item.classList.remove('active');
            });

            // اگر قبلاً باز نبود، بازش کن
            if (!wasActive) {
                parentLi.classList.add('active');
            }
        });
    });

    // بستن submenu با کلیک خارج از آن
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.has-submenu')) {
            document.querySelectorAll('.has-submenu').forEach(item => {
                item.classList.remove('active');
            });
        }
    });
});

    </script>

    @stack('scripts')

</div>
</body>
</html>
