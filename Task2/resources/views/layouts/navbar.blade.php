<div class="superNav border-bottom py-2 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 centerOnMobile">
                <span
                    class="d-none d-lg-inline-block d-md-inline-block d-sm-inline-block d-xs-none me-3"><strong>info@mail.com</strong></span>
                <span class="me-3"><i class="fa-solid fa-phone me-1 text-warning"></i> <strong>+49 0000 0000
                        0000</strong></span>
            </div>
            <div
                class="col-lg-6 col-md-6 col-sm-12 col-xs-12 d-none d-lg-block d-md-block-d-sm-block d-xs-none text-end">
                <span class="me-3"><i class="fa-solid fa-truck text-muted me-1"></i><a class="text-muted"
                        href="#">Contact</a></span>
                <span class="me-3"><i class="fa-solid fa-file  text-muted me-2"></i><a class="text-muted"
                        href="#">Policy</a></span>
            </div>
        </div>
    </div>
</div>
<nav class="navbar navbar-expand-lg bg-white sticky-top navbar-light p-3 shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}"><i class="fa-solid fa-shop me-2"></i> <strong>Forum
                APP</strong></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="mx-auto my-3 d-lg-none d-sm-block d-xs-block">
        </div>
        <div class=" collapse navbar-collapse" id="navbarNavDropdown">
            <div class="ms-auto d-none d-lg-block">
                <form method="GET" action="{{ route('search') }}">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control border-warning" style="color:#7a7a7a" name="search" placeholder="Search...">
                        <button type="submit" class="btn btn-warning text-white">Search</button>
                    </div>
                </form>
            </div>
            <ul class="navbar-nav ms-auto ">
                <li class="nav-item">
                    <a class="nav-link mx-2 text-uppercase active" aria-current="page"
                        href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-2 text-uppercase" href="#">About</a>
                </li>
                @if (!Auth::check())
                    <li class="nav-item">
                        <a class="nav-link mx-2 text-uppercase" href="{{ route('register') }}">Register</a>
                    </li>
                @endif
                <li class="nav-item">
                    @if (Auth::check())
                        <a class="nav-link mx-2 text-uppercase" href="#"
                            style=" background: #FFC107;border-radius: 7px;min-width: 120px;text-align: center;color: white;">{{ Auth::user()->name }}
                            {{ Auth::user()->surname }}</a>
                    @else
                        <a class="nav-link mx-2 text-uppercase" href="{{ route('login') }}"
                            style=" background: #FFC107;border-radius: 7px;min-width: 120px;text-align: center;color: white;">Login</a>
                    @endif
                </li>

            </ul>

        </div>
    </div>
</nav>
