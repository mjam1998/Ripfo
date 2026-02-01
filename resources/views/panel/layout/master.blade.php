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


</head>
<body>

<!-- Overlay -->
<div class="overlay"></div>

<!-- Sidebar -->
<div class="sidebar" id="side1" >
    <div class="sidebar-header" >
        <div class="user-avatar " ><img class="img-fluid " style="width:30px; height: 30px;"  src="{{asset('userpanel/img/store-03.2.png')}}" alt=""></div>
        <div class="user-info">
            <div class="user-name mt-3"><p style="font-size: small"></p></div>

            <div  class="user-status">

            </div>
        </div>
    </div>

    <div class="nav-menu">
        <ul>

            <li><a href="{{route('writer.index')}}"  class=""><i class="bi bi-vector-pen"></i> داشبورد نویسنده</a></li>
            <li><a href="{{route('writer.index')}}"  class=""><i class="bi bi-file-text"></i> ثبت مقاله جدید</a></li>


            <li><a href="#"  class=""><img class="img-fluid imm me-2" style="width:20px; height: 20px;"  src="{{asset('userpanel/img/logout.2.png')}}" alt=""> بازگشت به سایت</a></li>

        </ul>
    </div>

    <div class="sidebar-footer">
        <a href="#" style="color: red;"><i class="fas fa-sign-out-alt"></i> خروج از حساب کاربری</a>
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

    </script>


</div>
</body>
</html>
