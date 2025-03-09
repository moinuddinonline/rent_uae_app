<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Finigenie Admin | Login</title>
    <link rel="icon" href="{{ asset('assets/images/favicon-32x32.png') }}" type="image/png">
    {{--  plugins --}}
    <link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/metismenu/metisMenu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/metismenu/mm-vertical.css') }}">
    {{--  bootstrap css --}}
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
    <link href="{{ asset('assets/plugins/toaster/toastr.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/loader/css/jquery.loadingModal.css') }}" rel="stylesheet" />
    {{--  main css --}}
    <link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/sass/main.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/sass/dark-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/sass/responsive.css') }}" rel="stylesheet">

</head>

<body>
    <div class="section-authentication-cover">
        <div class="">
            <div class="row g-0">
                <div
                    class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex border-end">
                    <div class="card rounded-0 mb-0 border-0 shadow-none bg-transparent">
                        <div class="card-body">
                            <img src="{{ asset('assets/images/auth/login1.png') }}"
                                class="img-fluid auth-img-cover-login" width="650" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
                    <div class="card rounded-0 m-3 mb-0 border-0 shadow-none">
                        <div class="card-body p-sm-5">
                            <img src="{{ asset('assets/images/side_logo.png') }}" class="mb-4" width="100"
                                alt="side_logo">
                            <h4 class="fw-bold">Get Started Now</h4>
                            <p class="mb-0">Enter your credentials to login your account</p>
                            <div class="form-body mt-4">
                                <form id="login-form" name="login-form" class="row g-3 needs-validation"
                                    action="{{ route('dologin') }}" method="POST" novalidate>
                                    @csrf
                                    <div class="col-12">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="jhon@example.com">
                                    </div>
                                    <div class="col-12">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group" id="show_hide_password">
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="Enter Password">
                                            <a href="javascript:;" class="input-group-text bg-transparent"><i
                                                    class="bi bi-eye-slash-fill"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="remember"
                                                name="remember" value="1">
                                            <label class="form-check-label" for="remember">Remember
                                                Me</label>
                                        </div>
                                    </div>
                                    {{--  <div class="col-md-6 text-end"> <a href="#">Forgot
                                            Password ?</a>
                                    </div>  --}}
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-inverse-success">Login</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/toaster/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/loader/js/jquery.loadingModal.min.js') }}"></script>
    @include('scripts.common_script')
    @include('auth.auth_script')
</body>

</html>
