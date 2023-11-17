@extends('layouts.header')
@section('title', 'Checkout')
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
                        <h2>إتمام الطلب</h2>
                    </div>
                    <div class="page-top__breadcrumb">
                        <a class="text-gray" href="index.html">الرئيسية</a> /
                        <span class="text-gray">إتمام الطلب</span>
                    </div>
                </div>
            </section>

            <section class="section-container my-5 py-5 d-lg-flex">
                <div class="checkout__form-cont w-50 px-3 mb-5">
                    <h4>الفاتورة </h4>
                    <form class="checkout__form" action="{{ route('order.confirm' , ['total'=>$total]) }}" method="POST">
                        @csrf
                        @method('post')
                        <div class="mb-3">
                            <label for="last-name">المدينة / المحافظة<span class="required">*</span></label>
                            <select class="form__input bg-transparent" type="text" id="last-name" name="government">
                                <option value="" selected disabled>اختر المحافظة </option>
                                <option value="القاهرة" @selected( old('government') == 'القاهرة')>القاهرة</option>
                                <option value="اسكندرية"  @selected( old('government') == 'اسكندرية')>اسكندرية</option>
                            </select>
                        </div>
                        @error('government')
                            <div class="alert alert-danger" dir="ltr">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="mb-3">
                            <label for="last-name">العنوان بالكامل ( المنطقة -الشارع - رقم المنزل)<span
                                    class="required">*</span></label>
                            <input class="form__input" placeholder="رقم المنزل او الشارع / الحي" type="text"
                                id="last-name" name="address" value="{{ old('address') }}" />
                        </div>
                        @error('address')
                            <div class="alert alert-danger" dir="ltr">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="mb-3">
                            <label for="last-name">رقم الهاتف<span class="required">*</span></label>
                            <input class="form__input" type="number" id="last-name" name="phone" value="{{ old('phone') }}" />
                        </div>
                        @error('phone')
                            <div class="alert alert-danger" dir="ltr">
                                {{ $message }}
                            </div>
                        @enderror

                        <div class="mb-3">
                            <h2>معلومات اضافية</h2>
                            <label for="last-name">ملاحظات الطلب (اختياري)<span class="required">*</span></label>
                            <textarea class="form__input" placeholder="ملاحظات حول الطلب, مثال: ملحوظة خاصة بتسليم الطلب." type="text"
                                id="last-name" name="notes" {{ old('notes') }}></textarea>
                        </div>
                        @error('notes')
                            <div class="alert alert-danger" dir="ltr">
                                {{ $message }}
                            </div>
                        @enderror
                        <button class="primary-button w-100 py-2" type="submit">تاكيد الطلب</button>
                    </form>
                </div>
                <div class="checkout__order-details-cont w-50 px-3">
                    <h4>طلبك</h4>
                    <div>
                        <table class="w-100 checkout__table">
                            <thead>
                                <tr class="border-0">
                                    <th>المنتج</th>
                                    <th>المجموع</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total_discount = 0;
                                    $total_before_discount = 0;
                                @endphp
                                @forelse ($carts as $cart)
                                    <tr>
                                        <td>{{ $cart->products[0]->name }} × 1</td>
                                        <td>
                                            <div class="product__price text-center d-flex gap-2 flex-wrap">
                                                <span class="product__price product__price--old">
                                                    {{ $cart->products[0]->price }} جنيه
                                                </span>
                                                <span class="product__price"> {{ $cart->products[0]->price_after_discount }}
                                                    جنيه </span>
                                                @php
                                                    $total_discount += $cart->products[0]->price_after_discount;
                                                    $total_before_discount += $cart->products[0]->price;
                                                @endphp
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                                <tr>
                                    <th>المجموع</th>
                                    <td class="fw-bolder">{{ $total_before_discount }} جنيه</td>
                                </tr>
                                <tr class="bg-green">
                                    <th>قمت بتوفير</th>
                                    <td class="fw-bolder">{{ $total_before_discount - $total_discount }}جنيه</td>
                                </tr>
                                <tr>
                                    <th>الإجمالي</th>
                                    <td class="fw-bolder">{{ $total_discount }} جنيه</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="checkout__payment py-3 px-4 mb-3">
                        <p class="m-0 fw-bolder">الدفع نقدا عند الاستلام</p>
                    </div>

                    <p>الدفع عند التسليم مباشرة.</p>
                </div>
            </section>
        </main>
        @include('layouts.footer')
    @endsection
