<nav class="nav">
    <div class="section-container w-100 d-flex align-items-center gap-4 h-100">
        <div class="nav__categories-btn align-items-center justify-content-center rounded-1 d-none d-lg-flex">
            <button class="border-0 bg-transparent" data-bs-toggle="offcanvas" data-bs-target="#nav__categories">
                <i class="fa-solid fa-align-center fa-rotate-180"></i>
            </button>
        </div>
        <div class="nav__logo">
            <a href="{{ route('home') }}">
                <img class="h-100" src="{{ asset('assets') }}/images/logo.png" alt="">
            </a>
        </div>
        <div class="nav__search w-100">
            <input class="nav__search-input w-100" type="search" placeholder="أبحث هنا عن اي شئ تريده...">
            <span class="nav__search-icon">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
        </div>
        <ul class="nav__links gap-3 list-unstyled d-none d-lg-flex m-0">
            <!-- <li class="nav__link nav__link-user">
          <a class="d-flex align-items-center gap-2">
            حسابي
            <i class="fa-regular fa-user"></i>
            <i class="fa-solid fa-chevron-down fa-2xs"></i>
          </a>
          <ul class="nav__user-list position-absolute p-0 list-unstyled bg-white">
            <li class="nav__link nav__user-link"><a href="profile.html">لوحة التحكم</a></li>
            <li class="nav__link nav__user-link"><a href="orders.html">الطلبات</a></li>
            <li class="nav__link nav__user-link"><a href="account_details.html">تفاصيل الحساب</a></li>
            <li class="nav__link nav__user-link"><a href="favourites.html">المفضلة</a></li>
            <li class="nav__link nav__user-link"><a href="">تسجيل الخروج</a></li>
          </ul>
        </li> -->
            @guest
                @if (Route::has('login'))
                    <li class="nav__link">
                        <a class="d-flex align-items-center gap-2" href="{{ route('login') }}">
                            تسجيل الدخول
                            <i class="fa-regular fa-user"></i>
                        </a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            تسجيل الخروج
                        </a>


                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
            @auth

                <li class="nav__link">
                    <a class="d-flex align-items-center gap-2" href="{{ route('favorites') }}">
                        المفضلة
                        <div class="position-relative">
                            <i class="fa-regular fa-heart"></i>
                            <div class="nav__link-floating-icon">
                                {{ count(auth()->user()->favorites) }}
                            </div>
                        </div>
                    </a>
                </li>
                <li class="nav__link">
                    <a class="d-flex align-items-center gap-2" data-bs-toggle="offcanvas" data-bs-target="#nav__cart">
                        عربة التسوق
                        <div class="position-relative">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <div class="nav__link-floating-icon">
                                {{ count($carts) }}
                            </div>
                        </div>
                    </a>
                </li>
                <li class="nav__link">
                    <a class="d-flex align-items-center gap-2" href="{{ route('profile') }}">
                        حسابى
                    </a>
                </li>
            @endauth
        </ul>
    </div>
    <div class="nav-mobile fixed-bottom d-block d-lg-none">
        <ul class="nav-mobile__list d-flex justify-content-around gap-2 list-unstyled  m-0 border-top">
            <li class="nav-mobile__link">
                <a class="d-flex align-items-center flex-column gap-1 text-decoration-none"
                    href="{{ route('home') }}">
                    <i class="fa-solid fa-house"></i>
                    الرئيسية
                </a>
            </li>
            <li class="nav-mobile__link d-flex align-items-center flex-column gap-1" data-bs-toggle="offcanvas"
                data-bs-target="#nav__categories">
                <i class="fa-solid fa-align-center fa-rotate-180"></i>
                الاقسام
            </li>
            <li class="nav-mobile__link d-flex align-items-center flex-column gap-1">
                <a class="d-flex align-items-center flex-column gap-1 text-decoration-none" href="profile.html">
                    <i class="fa-regular fa-user"></i>
                    حسابي
                </a>
            </li>
            <li class="nav-mobile__link d-flex align-items-center flex-column gap-1">
                <a class="d-flex align-items-center flex-column gap-1 text-decoration-none"
                    href="{{ route('favorites') }}">
                    <i class="fa-regular fa-heart"></i>
                    المفضلة
                </a>
            </li>
            <li class="nav-mobile__link d-flex align-items-center flex-column gap-1" data-bs-toggle="offcanvas"
                data-bs-target="#nav__cart">
                <i class="fa-solid fa-cart-shopping"></i>
                السلة
            </li>
        </ul>
        <!--  -->
    </div>
</nav>
