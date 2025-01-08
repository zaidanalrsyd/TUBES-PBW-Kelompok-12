<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <!-- Title -->
    <title>Register</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin/images/logo.png') }}">
    <link href="{{ asset('admin/vendor/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/vendor/toastr/css/toastr.min.css') }}">
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;family=Roboto:wght@100;300;400;500;700;900&amp;display=swap"
        rel="stylesheet">
</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="text-center mb-3">
                                        <a href="/">
                                            <img src="{{ asset('admin/images/logo.png') }}" alt="Laravel Logo"
                                                style="width: 150px; height: auto;">
                                        </a>
                                    </div>
                                    <h4 class="text-center mb-4">Sign up your account</h4>
                                    <form action="{{ route('register') }}" method="POST">
                                        @csrf

                                        @if ($errors->any())
                                            <div class="alert alert-danger alert-dismissible fade show mt-2">
                                                <?php $nomer = 1; ?>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $nomer++ }}. {{ $error }}</li>
                                                @endforeach
                                            </div>
                                        @endif

                                        <div class="form-group">
                                            <label class="mb-1 form-label">Full Name</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ old('name') }}" placeholder="John Doe">
                                        </div>

                                        <div class="form-group">
                                            <label class="mb-1 form-label">Username <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="username" class="form-control"
                                                value="{{ old('username') }}" placeholder="Masukkan username">
                                        </div>

                                        <div class="form-group">
                                            <label class="mb-1 form-label">Email <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ old('email') }}" placeholder="Masukkan email anda">
                                        </div>

                                        <div class="mb-4 position-relative">
                                            <label class="mb-1 form-label">Password</label>
                                            <input type="password" name="password" id="dz-password" class="form-control"
                                                placeholder="Password">
                                            <span class="show-pass eye">
                                                <i class="fa fa-eye-slash"></i>
                                                <i class="fa fa-eye"></i>
                                            </span>
                                        </div>

                                        <div class="mb-4 position-relative">
                                            <label class="mb-1 form-label">Confirm Password</label>
                                            <input type="password" name="password_confirmation" id="dz-password-confirm"
                                                class="form-control" placeholder="Confirm Password">
                                            <span class="show-pass eye">
                                                <i class="fa fa-eye-slash"></i>
                                                <i class="fa fa-eye"></i>
                                            </span>
                                        </div>

                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary light btn-block">Sign Me
                                                Up</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3 text-center">
                                        <p>Already have an account? <a class="text-primary" href="/">Sign in</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('admin/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('admin/vendor/toastr/js/toastr.min.js') }}"></script>
    <!-- All init script -->
    <script src="{{ asset('admin/js/plugins-init/toastr-init.js') }}"></script>
    <script src="{{ asset('admin/js/custom.min.js') }}"></script>
    <script src="{{ asset('admin/js/deznav-init.js') }}"></script>

    @if (Session::get('success'))
        <script>
            toastr.success("{{ Session::get('success') }}", "Info", {
                timeOut: 2000,
                closeButton: !0,
                debug: !1,
                newestOnTop: !0,
                progressBar: !0,
                positionClass: "toast-top-right",
                preventDuplicates: !0,
                onclick: null,
                showDuration: "300",
                hideDuration: "1000",
                extendedTimeOut: "1000",
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut",
                tapToDismiss: !1
            })
        </script>
    @endif

</body>

</html>
