@extends('layouts.header')
@section('title', 'Branches')
@section('content')
    @include('layouts.start_header')
    @include('layouts.nav')
    @include('layouts.nav_side')
    @include('layouts.cart')
</div>
    <main>
        <div class="page-top d-flex justify-content-center align-items-center flex-column text-center">
            <div class="page-top__overlay"></div>
            <div class="position-relative">
                <div class="page-top__title mb-3">
                    <h2>حسابي</h2>
                </div>
                <div class="page-top__breadcrumb">
                    <a class="text-gray" href="{{ route('homePage') }}">الرئيسية</a>
                    <span class="text-gray">حسابي</span>
                </div>
            </div>
        </div>
        <div class="page-full pb-5">
            <div class="account account--login mt-5 pt-5">
                <div class="account__tabs w-100 d-flex mb-3">
                    <div class="account__tab account__tab--login text-center fs-6 py-3 w-50">
                        تسجيل الدخول
                    </div>
                    <div class="account__tab account__tab--register text-center fs-6 py-3 w-50">
                        حساب جديد
                    </div>
                </div>
                <div class="account__login w-100">
                    <form class="mb-5" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="input-group rounded-1 mb-3">
                            <input id="email" type="email" class="form-control p-3" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus
                                placeholder="البريد الالكتروني" aria-label="Email" aria-describedby="basic-addon1">
                            <span class="input-group-text login__input-icon" id="basic-addon1">
                                <i class="fa-solid fa-envelope"></i>
                            </span>
                        </div>
                        @error('email')
                            <div class="alert alert-danger" role="alert" dir="ltr">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                        <div class="input-group rounded-1 mb-3">
                            <input id="password" type="password" class="form-control p-3" placeholder="كلمة السر"
                                aria-label="Password" aria-describedby="basic-addon1" name="password" required
                                autocomplete="current-password">
                            <span class="input-group-text login__input-icon" id="basic-addon1">
                                <i class="fa-solid fa-key"></i>
                            </span>
                        </div>
                        @error('password')
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                        <div class="login__bottom d-flex justify-content-between mb-3">
                            <a class="login__forget-btn" href="">
                                نسيت كلمة المرور؟
                            </a>
                            <div>
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label for="">تذكرني</label>
                            </div>
                        </div>
                        <button type="submit" class="text-center fs-6 py-2 w-100 bg-black text-white border-0 rounded-1">
                            تسجيل الدخول
                        </button>
                    </form>
                </div>
                <div class="account__register w-100">
                    <form class="mb-5" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="input-group rounded-1 mb-3">
                            <input id="fname" type="text" class="form-control p-3" placeholder="الاسم الاول"
                                aria-label="Username" aria-describedby="basic-addon1" name="fname"
                                value="{{ old('fname') }}" required autocomplete="fname" autofocus />
                            <span class="input-group-text login__input-icon" id="basic-addon1">
                                <i class="fa-solid fa-user"></i>
                            </span>
                        </div>
                        @error('fname')
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                        <div class="input-group rounded-1 mb-3">
                            <input id="lname" type="text" class="form-control p-3" placeholder="الاسم الأخير"
                                aria-label="Username" aria-describedby="basic-addon1" name="lname"
                                value="{{ old('lname') }}" required autocomplete="lname" autofocus />
                            <span class="input-group-text login__input-icon" id="basic-addon1">
                                <i class="fa-solid fa-user"></i>
                            </span>
                        </div>
                        @error('lname')
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                        <div class="input-group rounded-1 mb-3">
                            <input id="name" type="text" class="form-control p-3" placeholder="الاسم كامل"
                                aria-label="Username" aria-describedby="basic-addon1" name="name"
                                value="{{ old('name') }}" required autocomplete="name" autofocus />
                            <span class="input-group-text login__input-icon" id="basic-addon1">
                                <i class="fa-solid fa-user"></i>
                            </span>
                        </div>
                        @error('name')
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                        <div class="input-group rounded-1 mb-3">
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                autocomplete="email" class="form-control p-3" placeholder="البريد الالكتروني"
                                aria-label="Email" aria-describedby="basic-addon1" />
                            <span class="input-group-text login__input-icon" id="basic-addon1">
                                <i class="fa-solid fa-envelope"></i>
                            </span>
                        </div>
                        @error('email')
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                        <div class="input-group rounded-1 mb-3">
                            <input id="password" type="password" name="password" required autocomplete="new-password"
                                class="form-control p-3" placeholder="كلمة السر" aria-label="Password"
                                aria-describedby="basic-addon1" />
                            <span class="input-group-text login__input-icon" id="basic-addon1">
                                <i class="fa-solid fa-key"></i>
                            </span>
                        </div>
                        <div class="input-group rounded-1 mb-3">
                            <input id="password-confirm" type="password" name="password_confirmation" required
                                autocomplete="new-password" class="form-control p-3" placeholder="تاكيد كلمة السر"
                                aria-label="Password" aria-describedby="basic-addon1" />
                            <span class="input-group-text login__input-icon" id="basic-addon1">
                                <i class="fa-solid fa-key"></i>
                            </span>
                        </div>
                        @error('password')
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                        <button type="submit" class="text-center fs-6 py-2 w-100 bg-black text-white border-0 rounded-1">
                            حساب جديد
                        </button>
                    </form>
                </div>
                <div class="account__forget">
                    <p>
                        فقدت كلمة المرور الخاصة بك؟ الرجاء إدخال عنوان البريد الإلكتروني
                        الخاص بك. ستتلقى رابطا لإنشاء كلمة مرور جديدة عبر البريد
                        الإلكتروني.
                    </p>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="input-group rounded-1 mb-3">
                            <input input id="email" type="email" @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                class="form-control p-3" placeholder="البريد الالكتروني" aria-label="Email"
                                aria-describedby="basic-addon1" />
                            <span class="input-group-text login__input-icon" id="basic-addon1">
                                <i class="fa-solid fa-envelope"></i>
                            </span>
                        </div>
                        @error('email')
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                        <button type="submit" class="text-center fs-6 py-2 w-100 bg-black text-white border-0 rounded-1">
                            اعادة تعيين كلمة المرور
                        </button>
                    </form>

                </div>
            </div>
        @include('layouts.footer')
    </main>

    @endsection
