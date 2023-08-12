<div class="col-12">
    <header class="row">
        <!-- Top Nav -->
        <div class="col-12 bg-dark py-2 d-md-block d-none">
            <div class="row">
                <div class="col-auto me-auto">
                    <ul class="top-nav">
                        <li>
                            <a href="tel:+123-456-7890"><i class="fa fa-phone-square me-2"></i>+977-9880713160</a>
                        </li>
                        <li>
                            <a href="mailto:mail@ecom.com"><i class="fa fa-envelope me-2"></i>mail@ecom.com</a>
                        </li>
                    </ul>
                </div>
                <div class="col-auto">
                    <ul class="top-nav">
                        @auth
                        <li>
                            <a href="#"><i class="fas fa-user-circle me-2"></i>{{ auth()->user()->name }}</a>
                        </li>
                        <form action="{{ route('logout') }}" method="post" class="d-inline">
                        @csrf
                             <li>
                                 <button type="submit" class="btn btn-link link-light text-decoration-none m-0 p-0"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></button>
                             </li>
                        </form>
                        @else
                        <li>
                            <a href="{{ route('register') }}"><i class="fas fa-user-edit me-2"></i>Register</a>
                        </li>
                        <li>
                            <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt me-2"></i>Login</a>
                        </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
        <!-- Top Nav -->

        <!-- Header -->
        <div class="col-12 bg-white pt-4">
            <div class="row">
                <div class="col-lg-auto">
                    <div class="site-logo text-center text-lg-left">
                        <a href="{{ route('front.pages.home') }}">E-Commerce</a>
                    </div>
                </div>
                <div class="col-lg-5 mx-auto mt-4 mt-lg-0">
                    <form action="{{ route('front.pages.search') }}" method="get">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="search" name="term" id="term" class="form-control border-dark" placeholder="Search..." value="{{ request('term') }}" required>
                                <button class="btn btn-outline-dark" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-auto text-center text-lg-left header-item-holder">
                    <a href="#" class="header-item">
                        <i class="fas fa-heart me-2"></i><span id="header-favorite">0</span>
                    </a>
                    <a href="{{ route('front.cart.index') }}" class="header-item">
                        <i class="fas fa-shopping-bag me-2"></i><span id="header-qty" class="me-3">{{ $totalQty }}</span>
                        <i class="fas fa-money-bill-wave me-2"></i><span id="header-price">Rs. {{ number_format($totalPrice) }}</span>
                    </a>
                </div>
            </div>

            <!-- Nav -->
            <div class="row">
                <nav class="navbar navbar-expand-lg navbar-light bg-white col-12">
                    <button class="navbar-toggler d-lg-none border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="mainNav">
                        <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('front.pages.home') }}">Home</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="electronics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories</a>
                                <div class="dropdown-menu" aria-labelledby="electronics">
                                    @foreach($categories as $category)
                                    <a class="dropdown-item" href="{{ route('front.pages.category', [$category->id]) }}">{{ $category->name }}</a>
                                    @endforeach
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="fashion" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Brands</a>
                                <div class="dropdown-menu" aria-labelledby="fashion">
                                    @foreach($brands as $brand)
                                    <a class="dropdown-item" href="{{ route('front.pages.brand', [$brand->id]) }}">{{ $brand->name }}</a>
                                    @endforeach
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <!-- Nav -->

        </div>
        <!-- Header -->

    </header>
</div>