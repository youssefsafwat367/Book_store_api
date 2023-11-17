@extends('layouts.header')
@section('title', 'Contacts')
@section('content')
    <body>
        @include('layouts.start_header')
        @include('layouts.nav')
        @include('layouts.nav_side')
        @include('layouts.cart')
    </div>

        <main>
            <section class="page-top d-flex justify-content-center align-items-center flex-column text-center ">
                <div class="page-top__overlay"></div>
                <div class="position-relative">
                    <div class="page-top__title mb-3">
                        <h2>تواصل معنا</h2>
                    </div>
                    <div class="page-top__breadcrumb">
                        <a class="text-gray" href="{{ route('homePage') }}">الرئيسية</a> /
                        <span class="text-gray">تواصل معنا</span>
                    </div>
                </div>
            </section>
            <section class="section-container py-5">
                <div class="row">
                    <div class="col-md-6 col-lg-3 mb-3">
                        <div class="contact__item h-100 d-flex align-items-center gap-2">
                            <div class="contact__icon">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <div>
                                <h6 class="contact__item-title m-0">اتصل بنا</h6>
                                <p class="contact__item-text m-0">01063888667</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-3">
                        <div class="contact__item h-100 d-flex align-items-center gap-2">
                            <div class="contact__icon">
                                <i class="fa-regular fa-envelope"></i>
                            </div>
                            <div>
                                <h6 class="contact__item-title m-0">راسلنا علي الايميل</h6>
                                <p class="contact__item-text m-0">eraasoft@gmail.com</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-3">
                        <div class="contact__item h-100 d-flex align-items-center gap-2">
                            <div class="contact__icon">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div>
                                <h6 class="contact__item-title m-0">العنوان</h6>
                                <p class="contact__item-text m-0">دعم فني على مدار اليوم للإجابة على اي استفسار لديك</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-3">
                        <div class="contact__item h-100 d-flex align-items-center gap-2">
                            <div class="contact__icon">
                                <i class="fa-solid fa-comments"></i>
                            </div>
                            <div>
                                <h6 class="contact__item-title m-0">دعم متواصل</h6>
                                <p class="contact__item-text m-0">يمكنك استبدال واسترجاع المنتج في حالة عدم مطابقة
                                    المواصفات.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section-container contact d-md-flex align-items-center mb-3">
                <div class="contact__side w-50">
                    <h4 class="mb-3">يسعدنا تواصلك معنا في أى وقت</h4>
                    <p>إذا كنت تواجه أي مشكلة أو ترغب في إسترجاع أو إستبدال المنتج لا تتردد أبدأ بالتواصل معنا في أي وقت. كل
                        ماعليك هو ملئ النموذج التالي ببيانات صحيحة وسنقوم بمراجعة طلبك في أسرع وقت.</p>
                        @if (session('success')!=NULL)
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    <form class="contact__form" action="{{ route('contacts.store')}}" method="POST">
                        @csrf
                        <div class="d-flex gap-3 mb-3">
                            <div class="w-50">
                                <label for="name">الاسم<span class="required">*</span></label>
                                <input class="contact__input" id="name" type="text" name="name">
                            </div>

                            <div class="w-50">
                                <label for="phone">رقم الهاتف<span class="required">*</span></label>
                                <input class="contact__input" id="phone" type="text" name="phone">
                            </div>

                        </div>
                        @error('name')
                                <div class="alert alert-danger" dir="ltr">
                                    {{ $message }}
                                </div>
                            @enderror
                            @error('phone')
                            <div class="alert alert-danger" dir="ltr">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="mb-3">
                            <label for="email">البريد الالكتروني<span class="required">*</span></label>
                            <input class="contact__input" id="email" type="text" name="email">
                        </div>
                        @error('email')
                                <div class="alert alert-danger" dir="ltr">
                                    {{ $message }}
                                </div>
                            @enderror
                        <div class="mb-3">
                            <label for="reason">سبب التواصل<span class="required">*</span></label>
                            <select class="contact__input" id="reason" name="subject">
                                <option value="" disabled selected>- اضغط هنا لاختيرا السبب -</option>
                                <option value="استفسار">استفسار</option>
                                <option value="استبدال">استبدال</option>
                                <option value="استرجاع">استرجاع</option>
                                <option value="استعجال اوردر">استعجال اوردر</option>
                                <option value="اخري">اخري</option>
                            </select>
                        </div>
                        @error('subject')
                                <div class="alert alert-danger" dir="ltr">
                                    {{ $message }}
                                </div>
                            @enderror
                        <div>
                            <label for="reason">نص الرسالة<span class="required">*</span></label>
                            <textarea class="contact__input" name="message" id=""></textarea>
                        </div>
                        @error('message')
                                <div class="alert alert-danger" dir="ltr">
                                    {{ $message }}
                                </div>
                            @enderror
                        <button type="submit" class="primary-button w-100 rounded-2">ارسال الطلب</button>
                    </form>
                </div>
                <div class="contact__side w-50 text-center">
                    <img class="w-100" src="{{asset('assets')}}/images/contact-1.png" alt="">
                </div>
            </section>
            <div class="section-container my-5 px-4">
                <div class="contact__map"></div>
            </div>
        </main>
        @include('layouts.footer')
    @endsection
