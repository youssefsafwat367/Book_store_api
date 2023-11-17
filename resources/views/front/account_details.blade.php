@extends('layouts.header')
@section('title', 'Account Details')
@section('content')

    <body>
        @include('layouts.start_header')
        @include('layouts.nav')
        @include('layouts.nav_side')
        @include('layouts.cart')
        </div>

        <main>
            <section class="page-top d-flex justify-content-center align-items-center flex-column text-center">
                <div class="page-top__overlay"></div>
                <div class="position-relative">
                    <div class="page-top__title mb-3">
                        <h2>حسابي</h2>
                    </div>
                    <div class="page-top__breadcrumb">
                        <a class="text-gray" href="{{ route('homePage') }}">الرئيسية</a> /
                        <span class="text-gray">حسابي</span>
                    </div>
                </div>
            </section>

            <section class="section-container profile my-3 my-md-5 py-5 d-md-flex gap-5">
                <div class="profile__right">
                    <div class="profile__user mb-3 d-flex gap-3 align-items-center">
                        <div class="profile__user-img rounded-circle overflow-hidden">
                            <img class="w-100" src="{{ asset('assets/uploads/users') }}/{{ auth()->user()->image }}"
                                alt="" />
                        </div>
                        <div class="profile__user-name">{{ auth()->user()->name }}</div>
                    </div>
                    <ul class="profile__tabs list-unstyled ps-3">
                        <li class="profile__tab">
                            <a class="py-2 px-3 text-black text-decoration-none" href="{{ route('profile') }}">لوحة
                                التحكم</a>
                        </li>
                        <li class="profile__tab">
                            <a class="py-2 px-3 text-black text-decoration-none" href="{{ route('orders') }}">الطلبات</a>
                        </li>

                        <li class="profile__tab active">
                            <a class="py-2 px-3 text-black text-decoration-none"
                                href="{{ route('account_details') }}">تفاصيل
                                الحساب</a>
                        </li>
                        <li class="profile__tab">
                            <a class="py-2 px-3 text-black text-decoration-none" href="{{ route('favorites') }}">المفضلة</a>
                        </li>
                        <li class="profile__tab">
                            <a class="link-primary" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                تسجيل الخروج
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="profile__left mt-4 mt-md-0 w-100">
                    <div class="profile__tab-content active">
                        <form class="profile__form border p-3"
                            action="{{ route('user.update', ['id' => auth()->user()->id]) }}" method="POST">
                            @if (session('success') != null)
                                <div class="alert alert-success" role="alert" dir="ltr">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('danger') != null)
                                <div class="alert alert-danger" role="alert" dir="ltr">
                                    {{ session('danger') }}
                                </div>
                            @endif
                            @csrf
                            <div class="d-flex gap-3 mb-3">
                                <div class="w-100">
                                    <label class="fw-bold mb-2" for="first-name">
                                        الاسم الاول <span class="required">*</span>
                                    </label>
                                    <input type="text" dir="ltr" class="form__input" id="first-name"
                                        value="{{ auth()->user()->fname }}" name="fname" />
                                </div>
                                <div class="w-100">
                                    <label class="fw-bold mb-2" for="last-name">
                                        الاسم الأخير <span class="required">*</span>
                                    </label>
                                    <input type="text" dir="ltr" class="form__input" id="last-name"
                                        value="{{ auth()->user()->lname }}" name="lname" />
                                </div>
                            </div>
                            @error('fname')
                                <div class="alert alert-danger" dir="ltr">
                                    {{ $message }}
                                </div>
                            @enderror
                            @error('lname')
                                <div class="alert alert-danger" dir="ltr">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="w-100">
                                <label class="fw-bold mb-2" for="displayed-name">
                                    الاسم كاملا<span class="required">*</span>
                                </label>
                                <input type="text" dir="ltr" class="form__input" id="displayed-name"
                                    value="{{ auth()->user()->name }}" name="name" />
                            </div>
                            @error('name')
                                <div class="alert alert-danger" dir="ltr">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="w-100 mb-3">
                                <label class="fw-bold mb-2" for="email">
                                    البريد الالكتروني<span class="required">*</span>
                                </label>
                                <input type="email" dir="ltr" class="form__input" id="email"
                                    value="{{ auth()->user()->email }}" name="email" />
                            </div>
                            @error('email')
                                <div class="alert alert-danger" dir="ltr">
                                    {{ $message }}
                                </div>
                            @enderror
                            <button type="submit" class="primary-button">تعديل</button>
                        </form>
                        <form action="{{ route('user.update_password', ['id' => auth()->user()->id]) }}" method="POST">
                            @csrf
                            <fieldset>
                                <legend class="fw-bolder">تغيير كلمة المرور</legend>
                                <div class="w-100 mb-3">
                                    <label class="fw-bold mb-2" for="current_password">
                                        كلمة المرور الجديدة (اترك الحقل فارغاً إذا كنت لا تودّ
                                        تغييرها)
                                    </label>
                                    @error('password')
                                        <div class="alert alert-danger" dir="ltr">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <input type="password" class="form__input" id="curr-password" name="password" />
                                </div>
                                <div class="w-100 mb-3">
                                    <label class="fw-bold mb-2" for="curr-password">
                                        تأكيد كلمة المرور الجديدة
                                    </label>
                                    <input type="password" class="form__input" id="curr-password"
                                        name="password_confirmation" />
                                </div>
                                <button class="primary-button">تغيير كلمة المرور</button>
                            </fieldset>
                        </form>
                    </div>



                </div>
            </section>
        </main>
        @include('layouts.footer')
    @endsection
