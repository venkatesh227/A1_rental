<?php use App\Models\Cart; ?>
<div class="navbar-area">
    <nav class="navbar navbar-area-2 navbar-area navbar-expand-lg">
        <div class="container-fluid nav-container">
            <div class="responsive-mobile-menu">
                <button class="menu toggle-btn d-block d-lg-none" data-target="#st_main_menu" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="icon-left"></span>
                    <span class="icon-right"></span>
                </button>
            </div>
            <div class="logo">
                <a href="{{ url('/') }}"><img src="{{ asset('fronted/img/logo1.png') }}" alt="img"></a>
            </div>
            <!-- <form action="{{ url('search-product') }}" class="search-form" method="POST">
                @csrf
                <div class="form-group">
                    <div class="input-group">
                        <input type="search" class="form-control" id="search-product" name="product-name" required
                            placeholder="Search.....">

                        <button type="submit" class="input-group-text" class="submit-btn"><i
                                class="fa fa-search"></i></button>

                    </div>
                </div>
            </form> -->
            <div class="collapse navbar-collapse" id="st_main_menu">
                <ul class="navbar-nav menu-open">
                    <li>
                        <a href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="menu-item-has-children">
                        <a href="#">Products</a>
                        <ul class="sub-menu">
                            @if (!empty($category))
                                @foreach ($category as $item)
                                    @if (!empty($item->status))
                                        <li><a href="{{ url('view-subCategory/' . $item->id) }}">{{ $item->name }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                    </li>
                    <li><a href="#">Portfolio</a></li>
                    <li><a href="{{url('email')}}">Contact Us</a></li>
                </ul>
            </div>

            <div class="nav-right-part nav-right-part-desktop">
                <a class="search-bar-btn" href="#"><i class="lnr lnr-magnifier"></i></a>

                <?php  $userLoggedIn = session()->has('userId'); ?>

                @if ($userLoggedIn)
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav menu-open">
                            <li class="menu-item-has-children">
                                <a href="#">{{ isset($user) ? $user->first_name : '' }}</a>
                                <ul class="sub-menu">
                                    <a href="{{ url('user-logout') }}">Logout</a>
                                </ul>
                            </li>
                        </ul>
                    </div>
                @else
                    <a class="user-btn" href="{{ url('user-login') }}"><i class="lnr lnr-user"></i></a>
                @endif

                <a class="cart-btn" href="{{ url('cart') }}">
                    <span class="cart-count">{{ Cart::where('user_id', session('userId'))->count() }}</span>
                    <i class="lnr lnr-cart"></i>
                </a>
            </div>
        </div>
    </nav>
</div>