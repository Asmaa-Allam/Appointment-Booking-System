{{-- resources/views/welcome.blade.php --}}
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام حجز المواعيد</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            direction: rtl;
            height: 100vh;
            background: linear-gradient(135deg, #0d6efd, #0dcaf0);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            border-radius: 20px;
        }
    </style>
</head>

<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card shadow-lg text-center p-5">

                <!-- عنوان -->
                <h2 class="mb-3">مرحبًا بك في نظام حجز المواعيد 👋</h2>

                <!-- نبذة -->
                <p class="text-muted mb-4">
                    يمكنك من خلال هذا النظام حجز المواعيد بسهولة، اختيار الخدمة المناسبة،
                    وتحديد الوقت المناسب لك دون تعقيد. نحن هنا لنوفر لك تجربة حجز سريعة ومريحة.
                </p>

                <!-- الأزرار -->
                <div class="d-flex justify-content-center gap-3">

                    <a href="{{ route('login.form') }}" class="btn btn-primary px-4">
                        تسجيل الدخول
                    </a>

                    <a href="{{ route('register.form') }}" class="btn btn-outline-primary px-4">
                        إنشاء حساب
                    </a>

                </div>

            </div>

        </div>
    </div>
</div>

</body>
</html>