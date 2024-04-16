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
                <a href="home.html"><img src="{{ asset('fronted/img/logo1.png') }}" alt="img"></a>
            </div>
            <div class="nav-right-part nav-right-part-mobile">
                <a class="search-bar-btn" href="#"><i class="lnr lnr-magnifier"></i></a>
                <a class="user-btn" href="wishlist.html"><i class="lnr lnr-user"></i></a>
                <a class="cart-btn" href="cart.html"><span class="cart-count">2</span><i
                        class="lnr lnr-cart"></i></a>
            </div>
            <div class="collapse navbar-collapse" id="st_main_menu">
                <ul class="navbar-nav menu-open">
                    <li class="menu-item-has-children current-item-has-children">
                        <a href="#">Home</a>
                    </li>
                    <li class="menu-item-has-children">
                        <a href="#">Products</a>
                        <ul class="sub-menu">
                            <li><a href="#">Tables</a></li>
                            <li><a href="#">Chairs</a></li>
                            <li><a href="#">Liners</a></li>
                            <li><a href="#">Tents</a></li>
                            <li><a href="#">Flooring</a></li>
                            <li><a href="#">Carpet</a></li>
                            <li><a href="#">Centerpiece</a></li>
                            <li><a href="#">Lighting</a></li>
                            <li><a href="#">Others</a></li>
                        </ul>
                    </li>

                    <li><a href="#">Portfolio</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>
            <div class="nav-right-part nav-right-part-desktop">
                <a class="search-bar-btn" href="#"><i class="lnr lnr-magnifier"></i></a>
                <a class="user-btn" href="{{ route('login') }}"><i class="lnr lnr-user"></i></a>

             
                <a class="cart-btn" href="#"><span class="cart-count">2</span><i class="lnr lnr-cart"></i></a>
            </div>
        </div>
    </nav>
</div>