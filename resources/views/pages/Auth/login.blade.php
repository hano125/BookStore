@extends('layouts.auth')
@section('title', 'تسجيل الدخول')
@section('content')
    <div class="wrapper vh-100">
        <div class="row align-items-center h-100">
            <form method="POST" action="{{ route('login.post') }}" class="col-lg-3 col-md-4 col-10 mx-auto text-center">
                @csrf

                {{-- Logo --}}
                <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ route('login') }}">
                    <svg version="1.1" id="logo" class="navbar-brand-img brand-md" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120"
                        xml:space="preserve">
                        <g>
                            <polygon class="st0" points="78,105 15,105 24,87 87,87" />
                            <polygon class="st0" points="96,69 33,69 42,51 105,51" />
                            <polygon class="st0" points="78,33 15,33 24,15 87,15" />
                        </g>
                    </svg>
                </a>

                <h1 class="h6 mb-3">تسجيل الدخول</h1>

                {{-- Global Error --}}
                @if ($errors->any())
                    <div class="alert alert-danger text-right mb-3">
                        @foreach ($errors->all() as $error)
                            <p class="mb-0 small">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                {{-- Email --}}
                <div class="form-group">
                    <label for="inputEmail" class="sr-only">البريد الإلكتروني</label>
                    <input type="email" id="inputEmail" name="email"
                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                        placeholder="البريد الإلكتروني" value="{{ old('email') }}" required autofocus>
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label for="inputPassword" class="sr-only">كلمة المرور</label>
                    <input type="password" id="inputPassword" name="password"
                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                        placeholder="كلمة المرور" required>
                </div>

                {{-- Remember Me --}}
                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
                        تذكرني
                    </label>
                </div>

                <button class="btn btn-lg btn-primary btn-block" type="submit">
                    <i class="fe fe-log-in fe-16 mr-2"></i>دخول
                </button>

                <p class="mt-5 mb-3 text-muted">&copy; {{ date('Y') }} نظام أرشفة الوثائق</p>
            </form>
        </div>
    </div>
@endsection
