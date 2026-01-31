<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>کد تأیید حساب کاربری</title>
    <style>
        body {
            font-family: Tahoma, Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
            direction: rtl;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,.08);
        }
        .header {
            background-color: #a89e45;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 30px;
            color: #333;
            line-height: 1.9;
            font-size: 15px;
        }
        .code-box {
            margin: 25px auto;
            text-align: center;
            font-size: 28px;
            letter-spacing: 6px;
            font-weight: bold;
            color: #0d6efd;
            background: #f1f5ff;
            padding: 15px;
            border-radius: 6px;
            width: fit-content;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 15px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>سامانه گزارش های پژوهشی</h2>
        <h4>دبیرخانه هیئت امنای سازمان تامین اجتماعی و صندوق های تابعه</h4>
    </div>

    <div class="content">
        <p>کاربر گرامی،</p>

        <p>
            برای تکمیل ثبت نام و فعال‌سازی حساب کاربری خود،
            لطفاً از کد تأیید زیر استفاده نمایید:
        </p>

        <div class="code-box">
            {{ $code }}
        </div>

        <p>
            اگر شما این درخواست را ثبت نکرده‌اید، لطفاً این ایمیل را نادیده بگیرید.
        </p>

        <p>
            با احترام<br>
            تیم پشتیبانی سامانه
        </p>
    </div>

    <div class="footer">
        <p>این ایمیل به صورت خودکار ارسال شده است، لطفاً به آن پاسخ ندهید.</p>
    </div>
</div>

</body>
</html>
