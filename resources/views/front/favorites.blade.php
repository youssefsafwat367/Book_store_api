@extends('layouts.header')
@section('title', 'Branches')
@section('content')

    <body>
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
                        <h2>المفضلة</h2>
                    </div>
                    <div class="page-top__breadcrumb">
                        <a class="text-gray" href="{{ route('homePage') }}">الرئيسية</a> /
                        <span class="text-gray">المفضلة</span>
                    </div>
                </div>
            </div>
            <div class="my-5 py-5">
                <section class="section-container favourites">
                    <table class="w-100">
                        <thead>
                            <th class="d-none d-md-table-cell"></th>
                            <th class="d-none d-md-table-cell"></th>
                            <th class="d-none d-md-table-cell">الاسم</th>
                            <th class="d-none d-md-table-cell">السعر</th>
                            <th class="d-none d-md-table-cell">تاريخ الاضافه</th>
                            <th class="d-none d-md-table-cell">المخزون</th>
                            <th class="d-table-cell d-md-none">product</th>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($favorites as $favorite)
                                <tr>
                                    <td class="d-block d-md-table-cell">
                                        <form action="{{ route('favorites.destroy', ['id' => $favorite->id]) }}" method="post"
                                            id="subForm">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="favourites__remove m-auto">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="d-block d-md-table-cell favourites__img">
                                        <img src="{{ asset('assets/uploads/products') }}/{{ $favorite->product->image }}"
                                            alt="" />
                                    </td>
                                    <td class="d-block d-md-table-cell">
                                        <a href=""> {{ $favorite->product->name }} </a>
                                    </td>
                                    <td class="d-block d-md-table-cell">
                                        <span class="product__price product__price--old">{{ $favorite->product->price }}
                                            جنية</span>
                                        <span class="product__price">{{ $favorite->product->price_after_discount }}
                                            جنية</span>
                                    </td>
                                    <td class="d-block d-md-table-cell">{{ $favorite->created_at }}</td>
                                    <td class="d-block d-md-table-cell">
                                        <span class="me-2"><i class="fa-solid fa-check"></i></span>
                                        <span class="d-inline-block d-md-none d-lg-inline-block">
                                            @if ($favorite->product->stock > 0)
                                                متوفر بالمخزون
                                            @else
                                                غير متوفر بالمخزون
                                            @endif


                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
            </div>
        </main>
        @include('layouts.footer')
    @endsection
