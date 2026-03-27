{{-- resources/views/home.blade.php --}}
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الرئيسية</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            direction: rtl;
        }
        .card {
            border-radius: 15px;
        }
    </style>
</head>

<body class="bg-light">

<!-- 🔹 Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <span class="navbar-brand">نظام الحجز</span>

        <div class="ms-auto">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-danger btn-sm">تسجيل الخروج</button>
            </form>
        </div>
    </div>
</nav>

<!-- 🔹 Content -->
<div class="container mt-5">

    {{-- رسالة نجاح --}}
    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <!-- 🔹 Welcome -->
    <div class="text-center mb-5">
        <h2>مرحبًا، {{ auth()->user()->name }} 👋</h2>
        <p class="text-muted">يمكنك الآن حجز الخدمات وإدارة مواعيدك بسهولة</p>
    </div>

    <!-- 🔹 Actions -->
    <div class="row justify-content-center">

        <!-- عرض الخدمات -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm text-center p-4">
                <h5 class="mb-3">الخدمات</h5>
                <p class="text-muted">تصفح الخدمات المتاحة واحجز موعدك</p>
                <a href="{{ route('services.index') }}" class="btn btn-primary">
                    عرض الخدمات
                </a>
            </div>
        </div>

        <!-- حجوزاتي -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm text-center p-4">
                <h5 class="mb-3">حجوزاتي</h5>
                <p class="text-muted">عرض وإدارة جميع حجوزاتك</p>
                <a href="{{ route('appointments.my') }}" class="btn btn-success">
                    حجوزاتي
                </a>
            </div>
        </div>

    </div>

    <!-- 🔹 ملخص سريع (اختياري) -->
    <div class="row justify-content-center mt-4">
        <div class="col-md-6">
            <div class="card shadow-sm text-center p-4">
                <h6 class="mb-2">ملخص سريع</h6>
                <p class="text-muted mb-0">
                    لديك {{ $appointmentsCount ?? 0 }} حجز (قابل للتطوير لاحقًا)
                </p>
            </div>
        </div>
    </div>

</div>

</body>
</html>