@extends('adminlte::page')
@section('title', 'orders')
@section('content')
    @include('layouts.admin.header')
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-4">
                            <h2>Manage <b>orders</b></h2>
                        </div>

                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Order Number</th>
                            <th>User Email </th>
                            <th>product name </th>
                            <th>Qunatity </th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>government</th>
                            <th>phone </th>
                            <th>address </th>
                            <th>notes </th>
                            <th>status </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td>{{ $order->order->id }}</td>
                                <td>{{ $order->order->user->email }}</td>
                                <td>{{ $order->product->name }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->price }}</td>
                                <td>{{ $order->order->total }}</td>
                                <td>{{ $order->order->government }}</td>
                                <td>{{ $order->order->phone }}</td>
                                <td>{{ $order->order->address }}</td>
                                <td>{{ $order->order->notes }}</td>
                                <td>{{ $order->order->status }}</td>
                                <td>
                                    @if ($order->order->status == 'قيد الانتظار')
                                    <x-delete-button
                                        action="{{ route('admin.orders.confirm', ['id' => $order->order->id]) }}"></x-delete-button>
                                    @elseif($order->order->status == 'تم تاكيد الطلب')

                                    <x-receive-order
                                        action="{{ route('admin.orders.received', ['id' => $order->order->id]) }}"></x-receive-order>
                                    @endif

                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </body>

    </html>
@endsection
