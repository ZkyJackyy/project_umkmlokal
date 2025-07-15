<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - UMKM LOKAL</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @section('navumkm', 'active')

    <style>
        html, body {
            height: 100%;
        }

        main > .container {
            padding: 80px 15px 40px;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 20px;
            color: white !important;
        }

        .nav-link {
            transition: 0.3s ease;
        }

        .nav-link:hover {
            color: #004080 !important;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        footer {
            font-size: 14px;
        }

        .btn-outline-light:hover {
            background-color: white;
            color: #0d6efd;
        }

        .btn-outline-dark:hover {
            background-color: #212529;
            color: white;
        }
    </style>
</head>

<body class="d-flex flex-column h-100">
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-info shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="/"><i class="bi bi-shop-window"></i> UMKM LOKAL</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link @yield('navhome')" href="/list-product">Home</a>
                        </li>
                        @auth
                        <li class="nav-item">
                            <a class="nav-link @yield('navstore')" href="/store/home">Toko</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @yield('navproduct')" href="/product/create/">Produk</a>
                        </li>
                        @if(auth()->user()->role !== 'saller')
                        <li class="nav-item">
                            <a class="nav-link @yield('navDftr')" href="/orders">Pesanan saya</a>
                        </li>
                        @elseif(auth()->user()->role !== 'customer')
                        <li class="nav-item">
                            <a class="nav-link @yield('navList')" href="/admin/orders">daftar pesanan
                                
                            </a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item">
                            <a class="nav-link @yield('navLogin')" href="/login">Login</a>
                        </li>
                        @endauth
                    </ul>

                    <form class="d-flex me-2" role="search">
                        <input name="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-light" type="submit">Search</button>
                    </form>

                    @auth
                        <form method="POST" action="/logout">
                            @csrf
                            <button type="submit" class="btn btn-outline-dark">Logout</button>
                        </form>
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    <main class="flex-shrink-0">
        <div class="container">
            @yield('container')
        </div>
    </main>

    <footer class="bg-info text-white text-center mt-auto py-3 shadow-sm">
        <div class="container">
            <p class="mb-0">
                &copy; {{ date('Y') }} UMKM LOKAL &middot;
                <a href="#" class="text-white text-decoration-underline">Privacy</a> &middot;
                <a href="#" class="text-white text-decoration-underline">Terms</a>
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</body>
</html>
