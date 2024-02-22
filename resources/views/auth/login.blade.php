<!doctype html>
<html lang="en"  dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light" data-menu-styles="dark">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>

        <!-- META DATA -->
        <meta charset="UTF-8">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="vexel – Laravel Bootstrap 5  Admin & Dashboard Template">
        <meta name="author" content="Spruko Technologies Private Limited">
        <meta name="keywords" content="admin panel template, admin dashboard template, admin panel, bootstrap admin template, dashboard, laravel, bootstrap dashboard, admin dashboard, admin panel laravel template, laravel framework, admin laravel, laravel admin panel.">

        <!-- TITLE -->
        <title>{{ env("APP_NAME") }}</title>

        <!-- Authentication JS -->
        <link rel="modulepreload" href="{{ url('/') }}/build/assets/authentication-main-d17b6bac.js" /><script type="module" src="{{ url('/') }}/build/assets/authentication-main-d17b6bac.js"></script>
        <!-- Favicon -->
        <link rel="icon" href="{{ url('/') }}/build/assets/images/brand/favicon.ico" type="image/x-icon">

        <!-- ICONS CSS -->
        <link href="{{ url('/') }}/build/assets/iconfonts/icons.css" rel="stylesheet">
        
        <!-- BOOTSTRAP CSS -->
        <link id="style" href="{{ url('/') }}/build/assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- APP CSS & APP SCSS -->
        <link rel="preload" as="style" href="{{ url('/') }}/build/assets/app-e29e56ca.css" /><link rel="modulepreload" href="{{ url('/') }}/build/assets/app-4ed993c7.js" /><link rel="stylesheet" href="{{ url('/') }}/build/assets/app-e29e56ca.css" /><script type="module" src="{{ url('/') }}/build/assets/app-4ed993c7.js"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    </head>
    <style>
        .header-brand-img {
            width: 150px;
            height: 70px;
            margin-top: 50px;
        }
    </style>
	<body class="app sidebar-mini ltr login-img">

        <!-- BACKGROUND-IMAGE -->
        <div class="">

            <!-- PAGE -->
            <div class="page">

                	
                <!-- CONTAINER OPEN -->
                <div class="">
                    <div class="text-center">
                        <a href="index"><img src="{{ url('/') }}/build/assets/images/brand/desktop-dark.png" class="header-brand-img" alt=""></a>
                    </div>
                </div>
                <div class="container-lg">
                    <div class="row justify-content-center mt-4 mx-0">
                        <div class="col-xl-4 col-lg-6">
                            <div class="card shadow-none">
                                <div class="card-body p-sm-6">
                                    <div class="text-center mb-4">
                                        <h4 class="mb-1">Sign In</h4>
                                        <p>Sign in to your account to continue.</p>
                                    </div>
                                    <form id="processAuthData" data-first="#loginBtn" data-type="Login" data-transform="no" data-url="{{ url('/') }}/login" data-redirect="true" data-redirect-to="{{ route('login') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label class="mb-2 fw-500">Email<span class="text-danger ms-1">*</span></label>
                                                    <input class="form-control ms-0" type="email" name="email" placeholder="Enter your Email">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label class="mb-2 fw-500">Password<span class="text-danger ms-1">*</span></label>
                                                    <div >
                                                        <input type="password" class="form-control" name="password" id="input-password" placeholder="Password">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                {{-- <div class="d-flex mb-3">
                                                    <div class="form-check d-flex align-items-center">
                                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                        <label class="form-check-label tx-15" for="flexCheckDefault">
                                                            Remember me
                                                        </label>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <a href="forgot-password.html" class="tx-primary ms-1 tx-13">Forgot Password?</a>
                                                    </div>
                                                </div> --}}
                                                <div class="d-grid mb-3">
                                                    <button type="submit" class="btn btn-primary" id="loginBtn"> Login</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- CONTAINER CLOSED -->
            </div>
            <!-- End PAGE -->
        </div>

        <!-- Bootstrap JS -->
    	<script src="{{ url('/') }}/build/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Custom-Switcher JS -->
        <link rel="modulepreload" href="{{ url('/') }}/build/assets/custom-switcher-aff38aa1.js" />
        <link rel="modulepreload" href="{{ url('/') }}/build/assets/defaultmenu-7feba3a7.js" />
        <script type="module" src="{{ url('/') }}/build/assets/custom-switcher-aff38aa1.js"></script>
        <script type="module" src="{{ url('/') }}/build/assets/auth.js"></script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    </body>
</html>    


