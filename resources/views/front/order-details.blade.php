@extends('layouts.header')
@section('title', 'Branches')
@section('content')

    <body>
        @include('layouts.start_header')
        @include('layouts.nav')
        @include('layouts.nav_side')
        @include('layouts.cart')
        </div>

    @section('content')
        <main>
            <div class="page-top d-flex justify-content-center align-items-center flex-column text-center">
                <div class="page-top__overlay"></div>
                <div class="position-relative">
                    <div class="page-top__title mb-3">
                        <h2>تتبع طلبك</h2>
                    </div>
                    <div class="page-top__breadcrumb">
                        <a class="text-gray" href="index.html">الرئيسية</a> /
                        <span class="text-gray">تتبع طلبك</span>
                    </div>
                </div>
            </div>
            <section class="section-container my-5 py-5">
                <p>
                    تم تقديم الطلب #{{ $order->id }} فى {{ $order->created_at }} وهو الآن بحالة  {{ $order->status }}.
                </p>

                <section>
                    <h2>تفاصيل الطلب</h2>
                    <table class="success__table w-100 mb-5">
                        <thead>
                            <tr class="border-0 bg-danger text-white">
                                <th>المنتج</th>
                                <th class="d-none d-md-table-cell">الإجمالي</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($order_products as $order_product)
                                <tr>
                                    <td>
                                        <div>

                                    <div><a href="">{{ $order_product->product->name}}</a> x {{ $order_product->quantity }}</div>
                                        </div>
                                        <div>
                                            <span class="fw-bold">وصف المنتج :</span>
                                            <span>{{ $order_product->product->description }}</span>
                                        </div>
                                        <div>
                                            <span class="fw-bold">المولف:</span>
                                            <span>{{ $order_product->product->author}}</span>
                                        </div>
                                    </td>
                                    <td>{{  $order_product->price }}.00 جنيه</td>
                                </tr>
                            @empty
                            @endforelse ()
                        </tbody>
                    </table>
                </section>
                <section class="mb-5">
                    <h2>عنوان الفاتورة</h2>
                    <div class="border p-3 rounded-3">
                       <p class="mb-1">العنوان :-  <strong>{{  $order_product->order->address }}</strong> </p>
                        <p class="mb-1">المحافظة:-  <strong>{{  $order_product->order->government }}</strong></p>
                        <p class="mb-1">حالة الطلب :-  <strong>{{  $order_product->order->status }}</strong></p>
                        <p class="mb-1">تفاصيل زيادة الطلب :-  <strong>{{  $order_product->order->notes }}</strong></p>
                        <p class="mb-1">رقم الهاتف :-  <strong>{{  $order_product->order->phone }}</strong></p>
                        <p class="mb-1">اجمالى الطلب :-  <strong>{{  $order_product->order->total }}</strong></p>
                    </div>
                </section>
            </section>
        </main>
        @include('layouts.footer')
    @endsection
