{{-- resources/views/auth/register.blade.php --}}

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل حساب جديد</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header text-center bg-primary text-white">
                        <h4>تسجيل حساب جديد</h4>
                    </div>
                    <div class="card-body">
                        {{-- عرض رسائل الأخطاء --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- نموذج التسجيل --}}
                        <form method="POST" action="{{ route('register.submit') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">الاسم الكامل</label>
                                <input type="text" name="name" id="name" 
                                    class="form-control @error('name') is-invalid @enderror" 
                                    value="{{ old('name') }}" required autofocus>
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">البريد الإلكتروني</label>
                                <input type="email" name="email" id="email" 
                                    class="form-control @error('email') is-invalid @enderror" 
                                    value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">كلمة المرور</label>
                                <input type="password" name="password" id="password" 
                                    class="form-control @error('password') is-invalid @enderror" 
                                    required>
                                @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">تأكيد كلمة المرور</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" 
                                    class="form-control" required>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">تسجيل</button>
                            </div>
                        </form>

                        <p class="mt-3 text-center">
                            لديك حساب بالفعل؟ <a href="{{ route('login.form') }}">تسجيل الدخول</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>