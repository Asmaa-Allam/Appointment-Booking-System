{{-- resources/views/services/index.blade.php --}}
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الخدمات</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            direction: rtl;
        }
        .card {
            border-radius: 12px;
        }
        .card-title {
            font-weight: bold;
        }
        .service-meta {
            font-size: 14px;
            color: #6c757d;
        }
    </style>
</head>

<body class="bg-light">

<!-- 🔹 Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">نظام الحجز</a>

        <div class="ms-auto">
            <a href="{{ route('home') }}" class="btn btn-light btn-sm">الرئيسية</a>
            <a href="{{ route('logout') }}" class="btn btn-danger btn-sm">تسجيل الخروج</a>
        </div>
    </div>
</nav>

<!-- 🔹 Page Header -->
<div class="container mt-4">
    <div class="text-center mb-4">
        <h2>الخدمات المتاحة</h2>
        <p class="text-muted">اختر الخدمة المناسبة لك واحجز موعدك بسهولة</p>
    </div>

    {{-- رسالة نجاح --}}
    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    {{-- في حال لا يوجد خدمات --}}
    @if($services->isEmpty())
        <div class="alert alert-info text-center">
            لا توجد خدمات متاحة حالياً
        </div>
    @endif

    <!-- 🔹 Services Grid -->
    <div class="row">
        @foreach($services as $service)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">

                    <div class="card-body d-flex flex-column">

                        <!-- اسم الخدمة -->
                        <h5 class="card-title">{{ $service->name }}</h5>

                        <!-- الوصف -->
                        <p class="card-text text-muted">
                            {{ $service->description }}
                        </p>

                        <!-- معلومات إضافية -->
                        <div class="service-meta mb-3">
                            ⏱ المدة: {{ $service->duration_minutes }} دقيقة <br>
                            💰 السعر: {{ $service->price }} ريال
                        </div>

                        <!-- زر الحجز -->
                        <div class="mt-auto">
                            <a href="{{ route('appointments.create', $service->id) }}" 
                               class="btn btn-primary w-100">
                                احجز الآن
                            </a>
                        </div>

                    </div>

                </div>
            </div>
        @endforeach
    </div>
</div>

</body>
</html>