<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CleanHub Laundry</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
        }
        .hero-text {
            font-size: 4.5rem;
            font-weight: 800;
            line-height: 1.2;
        }
        .highlight {
            font-size: 5.5rem;
            color: #2B49E3;
        }
        .hero-image-offset {
        margin-left: 40px; /* atau sesuaikan seperti 60px atau 5rem */
    }
    </style>
</head>
<body>
    <!-- NAVBAR -->
    <nav class="d-flex justify-content-between align-items-center px-4 py-3">
        <div class="d-flex align-items-center">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" height="30" class="me-2">
        </div>
        <div>
            <button class="btn btn-outline-dark me-2" onclick="openLogin()">Login</button>
            <button class="btn btn-primary" onclick="openRegister()">Regist</button>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <div class="container mt-5">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="hero-text">Grow your laundry business with <span class="highlight">Clean Hub</span></h1>
                <p class="text-muted mt-3">An all-in-one platform to manage, monitor, and scale your laundry operations.</p>
            </div>
            <div class="col-md-6 ps-md-5 d-flex justify-content-end">
                <img src="{{ asset('img/phone.dashboard.png') }}" class="img-fluid" alt="Hero Image">
            </div>
        </div>
    </div>

    <!-- WHY CLEAN HUB SECTION -->
<div class="bg-cleanhub py-5">
    <div class="container text-white">
        <h2 class="text-center fw-bold mb-3">Why Clean Hub?</h2>
        <p class="text-center mb-5 fw-medium">
            CleanHub is built to empower laundry business owners with smart tools that simplify operations, 
            boost efficiency, and enhance customer satisfaction.
        </p>

        <div class="row g-4">
            <!-- Order Management -->
            <div class="col-md-6">
                <div class="bg-white rounded-4 p-4 d-flex align-items-start gap-3 h-100">
                    <img src="{{ asset('img/order.png') }}" width="80" alt="Order">
                    <div>
                        <h5 class="fw-bold text-dark">Order Management</h5>
                        <p class="text-dark mb-0">Easily handle pick-up and drop-off requests with a centralized system that keeps you in control — no more manual logs or missed orders.</p>
                    </div>
                </div>
            </div>

            <!-- Analytics Dashboard -->
            <div class="col-md-6">
                <div class="bg-white rounded-4 p-4 d-flex align-items-start gap-3 h-100">
                    <img src="{{ asset('img/analytics.png') }}" width="80" alt="Analytics">
                    <div>
                        <h5 class="fw-bold text-dark">Analytics Dashboard</h5>
                        <p class="text-dark mb-0">Monitor your income, order volume, and customer behavior in real time with intuitive visual reports that help you make better decisions.</p>
                    </div>
                </div>
            </div>

            <!-- Delivery Service -->
            <div class="col-md-6">
                <div class="bg-white rounded-4 p-4 d-flex align-items-start gap-3 h-100">
                    <img src="{{ asset('img/delivery.png') }}" width="80" alt="Delivery">
                    <div>
                        <h5 class="fw-bold text-dark">Delivery Service</h5>
                        <p class="text-dark mb-0">Optimize pickup and delivery routes to save time.</p>
                    </div>
                </div>
            </div>

            <!-- Smart Notification -->
            <div class="col-md-6">
                <div class="bg-white rounded-4 p-4 d-flex align-items-start gap-3 h-100">
                    <img src="{{ asset('img/notification.png') }}" width="80" alt="Notification">
                    <div>
                        <h5 class="fw-bold text-dark">Smart Notification</h5>
                        <p class="text-dark mb-0">Stay updated with automated alerts on new orders, payment status, and delivery progress — right when it happens.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- HOW IT WORKS SECTION -->
<div class="py-5 bg-white">
    <div class="container text-center">
        <h2 class="fw-bold mb-5 text-dark">How it Works?</h2>
        <div class="row g-5 justify-content-center">

        <!-- STEP 1 -->
        <div class="col-md-4 d-flex align-items-center mb-4">
            <div class="step-number bg-warning text-white fw-bold rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                1
            </div>
            <div class="text-start">
                <img src="{{ asset('img/step1.png') }}" alt="Step 1" class="mb-2" width="50">
                <p class="mb-0 fw-semibold">Register your store</p>
            </div>
        </div>

        <!-- STEP 2 -->
        <div class="col-md-4 d-flex align-items-center mb-4">
            <div class="step-number bg-warning text-white fw-bold rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                2
            </div>
            <div class="text-start">
                <img src="{{ asset('img/step2.png') }}" alt="Step 2" class="mb-2" width="50">
                <p class="mb-0 fw-semibold">Manage orders & track progress</p>
            </div>
        </div>

        <!-- STEP 3 -->
        <div class="col-md-4 d-flex align-items-center mb-4">
            <div class="step-number bg-warning text-white fw-bold rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                3
            </div>
            <div class="text-start">
                <img src="{{ asset('img/step3.png') }}" alt="Step 3" class="mb-2" width="50">
                <p class="mb-0 fw-semibold">Grow with data insights</p>
            </div>
        </div>
        </div>
    </div>
</div>

    <!-- FOOTER -->
<footer class="bg-cleanhub py-5">
    <div class="container">
        <div class="row">
            <!-- Logo & Alamat -->
            <div class="col-md-4 mb-4">
                <div class="d-flex align-items-center mb-2">
                    <img src="{{ asset('img/logo2.png') }}" alt="Cleanhub Logo" width="60" class="me-2">
                    <h5 class="text-white fw-bold">CleanHub</h5>
                </div>
                <p class="text-light mb-0">Jl. Prof. Dr. Suharso No.45, Mangunjaya, Tegal</p>
            </div>

            <!-- Links -->
            <div class="col-md-4 mb-4">
                <h5 class="text-white fw-bold">Links</h5>
                <ul class="list-unstyled">
                    <li><a href="#home" class="text-white text-decoration-none">› Home</a></li>
                    <li><a href="#why" class="text-white text-decoration-none">› Why Cleanhub</a></li>
                    <li><a href="#how" class="text-white text-decoration-none">› How it Works</a></li>
                </ul>
            </div>

            <!-- Information -->
            <div class="col-md-4 mb-4">
                <h5 class="text-white fw-bold">Information</h5>
                <ul class="list-unstyled">
                    <li>
                        <i class="bi bi-instagram text-white me-2"></i>
                        <a href="#" class="text-white text-decoration-none">Instagram</a>
                    </li>
                    <li>
                        <i class="bi bi-tiktok text-white me-2"></i>
                        <a href="#" class="text-white text-decoration-none">Tiktok</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<!-- Modal Login -->
<div id="loginModal" class="login-modal" style="display:none;">
    <div class="login-content">
        <img src="{{ asset('img/logo2.png') }}" alt="Logo" class="login-logo">
        <h4 class="text-center fw-bold">Welcome Back!</h4>
        <p class="text-center text-muted">Please login first</p>
        @if ($errors->has('email'))
            <div class="alert alert-danger">
                {{ $errors->first('email') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <label class="form-label mt-3">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Please enter your email" required>

            <label class="form-label mt-3">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Please enter your password" required>

            <button type="submit" class="btn btn-primary w-100 mt-4">Login</button>
        </form>

        <p class="text-center mt-3 text-muted">
            Don’t have an account? <a href="#" onclick="switchToRegister()" class="fw-bold text-primary">Regist</a>
        </p>
    </div>
</div>


<!-- Modal Register -->
<div id="registerModal" class="login-modal">
    <div class="login-content register-content">
        <h3 class="text-center fw-bold">Register</h3>
        <p class="text-center text-muted">Before login, please register first</p>

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="row gx-3 mt-4">
                <!-- Kolom Kiri -->
                <div class="col-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Please enter your email" required>

                    <label class="form-label mt-3">Laundry Name</label>
                    <input type="text" name="laundry_name" class="form-control" placeholder="Please enter your laundry name" required>

                    <label class="form-label mt-3">Laundry Address</label>
                    <input type="text" name="laundry_address" class="form-control" placeholder="Please enter your laundry address" required>

                    <label class="form-label mt-3">Description</label>
                    <input type="text" name="description" class="form-control" placeholder="Please enter your laundry description">
                </div>

                <!-- Kolom Kanan -->
                <div class="col-6">
                    <label class="form-label">Phone Number</label>
                    <input type="text" name="phone_number" class="form-control" placeholder="Please enter your phone number" required>

                    <label class="form-label mt-3">Account Number</label>
                    <input type="text" name="account_number" class="form-control" placeholder="Please enter your account number">

                    <label class="form-label mt-3">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter password" required>

                    <label class="form-label mt-3">Repeat Password</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat your password" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-4">Register</button>
        </form>

        <p class="text-center mt-3 text-muted">
            Have an account? <a href="#" class="fw-bold text-primary" onclick="switchToLogin()">Login</a>
        </p>
    </div>
</div>
@if(session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
@endif
<!-- Script modal login dan regist -->
<script>
    function openLogin() {
        document.getElementById('loginModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function switchToRegister() {
        document.getElementById('loginModal').style.display = 'none';
        document.getElementById('registerModal').style.display = 'flex';
    }

    function openRegister() {
        document.getElementById('registerModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function switchToLogin() {
        document.getElementById('registerModal').style.display = 'none';
        document.getElementById('loginModal').style.display = 'flex';
    }

    window.onclick = function(event) {
        const loginModal = document.getElementById('loginModal');
        const registerModal = document.getElementById('registerModal');

        if (event.target === loginModal) {
            loginModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        if (event.target === registerModal) {
            registerModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    }
</script>



