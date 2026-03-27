{{-- resources/views/appointments/create.blade.php --}}
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>حجز موعد</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { direction: rtl; }
        .card { border-radius: 12px; }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm p-4">
                <h4 class="text-center mb-4">حجز: {{ $service->name }}</h4>

                {{-- أخطاء التحقق --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('appointments.store') }}">
                    @csrf
                    <input type="hidden" name="service_id" value="{{ $service->id }}">

                    <!-- {{-- اختيار التاريخ --}}
                    <div class="mb-3">
                        <label for="date" class="form-label">اختر التاريخ</label>
                        <input type="date" id="date" name="date"
                               class="form-control"
                               value="{{ old('date') }}"
                               required
                               min="{{ date('Y-m-d') }}">
                    </div> -->

                    {{-- اختيار الوقت --}}
                    <div class="mb-3">
                        <label for="start_time" class="form-label">اختر التاريخ والوقت</label>
                        <input type="datetime-local" id="start_time" name="start_time"
                            class="form-control"
                            value="{{ old('start_time') }}"
                            required
                            min="{{ date('Y-m-d\TH:i') }}">
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">تأكيد الحجز</button>
                    </div>

                    <div class="text-center mt-3">
                        <a href="{{ route('services.index') }}">عودة للخدمات</a>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>

</body>
</html>