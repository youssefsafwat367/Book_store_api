<div class="nav__cart offcanvas offcanvas-end px-3 py-2" tabindex="-1" id="nav__cart" aria-labelledby="nav__cart">
    <div class="nav__categories-header offcanvas-header align-items-center">
        <h5>سلة التسوق</h5>
        <button type="button" class="border-0 bg-transparent text-danger nav__close" data-bs-dismiss="offcanvas"
            aria-label="Close">
            <i class="fa-solid fa-x fa-1x fw-light"></i>
        </button>
    </div>
    <div class="nav__categories-body offcanvas-body pt-4">
        @auth
            {{-- @if ($carts[0]->user_id == null)
<p> لا توجد منتجات في سلة المشتريات.</p>
        @endif --}}

            @php
                $total_price = 0;
            @endphp
            @foreach ($carts as $cart)
                <div class="cart-products">
                    <ul class="nav__list list-unstyled">
                        <li class="cart-products__item d-flex justify-content-between gap-2">
                            <div class="d-flex gap-2">
                                <div>
                                    <form action="{{ route('cart.delete', ['cart_id' => $cart->id]) }}" method="post"
                                        id="subForm">
                                        @method('delete')
                                        @csrf

                                        <input type="submit" class="cart-products__remove" value="x"
                                            id="subFormSubmit">

                                    </form>
                                </div>
                                <div>
                                    <p class="cart-products__name m-0 fw-bolder">{{ $cart->products[0]->name }} </p>
                                    <p class="cart-products__price m-0"> {{ $cart->cart_products[0]->quantity }} x
                                        {{ $cart->products[0]->price_after_discount }} حنيه </p>
                                </div>
                            </div>
                            <div class="cart-products__img">
                                <img class="w-100"
                                    src="{{ asset('assets/uploads/products') }}/{{ $cart->products[0]->image }}"
                                    alt="">
                            </div>
                        </li>
                    </ul>
                    <div class="d-flex justify-content-between">
                        <p class="fw-bolder">المجموع:</p>
                        <p>{{ $cart->total }}.00 جنيه</p>
                    </div>
                </div>
                @php
                    $total_price += $cart->total;
                @endphp
            @endforeach
            @if ($total_price != 0)
            <div class="d-flex justify-content-between">
                <p class="fw-bolder">اجمالى الطلب</p>
                <p>{{ $total_price }}.00 جنيه</p>
            </div>

            <form action="{{ route('checkout' , ['total'=>$total_price]) }}" method="post">
                @method('get')
                <button type="submit"
                class="nav__cart-btn text-center text-white w-100 border-0 mb-3 py-2 px-3 bg-success">اتمام
                الطلب</button>
            </form>
            @endif
        @endauth
    </div>
</div>

@push('ja')
    <script></script>
@endpush
