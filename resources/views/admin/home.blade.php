@extends('adminlte::page')
@section('title', 'Home')
@section('content')
    @include('layouts.admin.header')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Project Gallery</title>
        <style>
            body {
                font-family: Arial, sans-serif;
            }

            .gallery {
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
                justify-content: center;
                padding: 50px;
            }

            .card {
                width: 300px;
                position: relative;
                overflow: hidden;
            }

            .card img {
                width: 100%;
                transition: transform 0.3s ease;
            }

            .card:hover img {
                transform: scale(1.1);
            }

            .card .details {
                position: absolute;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                color: #fff;
                width: 100%;
                text-align: center;
                padding: 20px;
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .card:hover .details {
                opacity: 1;
            }
        </style>
    </head>

    <body>

        <div class="gallery">
            <a href="{{ route('admin.users') }}">
                <div class="card">
                    <img src="{{ asset('assets/uploads/icons/users.png') }}" alt="users.png">
                    <div class="details">View Users </div>
                </div>
            </a>
            <a href="{{ route('admin.categories') }}">
                <div class="card">
                    <img src="{{ asset('assets/uploads/icons/categories.png') }}" alt="categories.png">
                    <div class="details">View Categories</div>
                </div>
            </a>
            <a href="{{ route('admin.products') }}">
                <div class="card">
                    <img src="{{ asset('assets/uploads/icons/products.png') }}" alt="products.png">
                    <div class="details">View Products</div>
                </div>
            </a>
            <a href="{{ route('admin.sliders') }}">
                <div class="card">
                    <img src="{{ asset('assets/uploads/icons/sliders.png') }}" alt="sliders.png">
                    <div class="details">View Slides</div>
                </div>
            </a>

            <a href="{{ route('admin.orders') }}">
                <div class="card">
                    <img src="{{ asset('assets/uploads/icons/orders.png') }}" alt="orders.png">
                    <div class="details">View Orders</div>
                </div>
            </a>
            <a href="{{ route('admin.branches') }}">
                <div class="card">
                    <img src="{{ asset('assets/uploads/icons/branches.png') }}" alt="branches.png">
                    <div class="details">View Branches</div>
                </div>
            </a>
              <a href="{{ route('admin.contacts') }}">
                <div class="card">
                    <img src="{{ asset('assets/uploads/icons/contacts.png') }}" alt="contacts.png">
                    <div class="details">View contacts</div>
                </div>
            </a>
            <!-- Repeat the .card block for each project -->
        </div>

    </body>

    </html>
@endsection
