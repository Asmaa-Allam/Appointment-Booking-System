{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card shadow-sm">
                <div class="card-header text-center bg-primary text-white">
                    <h4>تسجيل الدخول</h4>
                </div>

                <div class="card-body">

                    {{-- رسالة نجاح --}}
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

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

                    {{-- نموذج تسجيل الدخول --}}
                    <form method="POST" action="{{ route('login.submit') }}">
                        @csrf

                        {{-- البريد الإلكتروني --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">البريد الإلكتروني</label>
                            <input 
                                type="email" 
                                name="email" 
                                id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}"
                                required
                                autofocus
                            >

                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- كلمة المرور --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">كلمة المرور</label>
                            <input 
                                type="password" 
                                name="password" 
                                id="password"
                                class="form-control @error('password') is-invalid @enderror"
                                required
                            >

                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- زر الدخول --}}
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                تسجيل الدخول
                            </button>
                        </div>

                    </form>

                    {{-- رابط التسجيل --}}
                    <p class="mt-3 text-center">
                        لا تملك حساب؟ 
                        <a href="{{ route('register.form') }}">إنشاء حساب</a>
                    </p>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>