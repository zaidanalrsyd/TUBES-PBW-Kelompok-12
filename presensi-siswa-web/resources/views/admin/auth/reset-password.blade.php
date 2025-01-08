<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <title>Presensi - Reset Password</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
                                    <h4 class="text-center mb-4">Reset Password</h4>

                                    @if ($errors->any())
                                        <div class="alert alert-danger alert-dismissible fade show mt-2">
                                            <?php $nomer = 1; ?>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $nomer++ }}. {{ $error }}</li>
                                            @endforeach
                                        </div>
                                    @endif

                                    <form action="{{ route('password.update') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="token" value="{{ $token }}">
                                        <p class="text-center mb-4">Reset password untuk:
                                            <strong>{{ $email }}</strong>
                                        </p>

                                        <div class="mb-4 position-relative">
                                            <label class="mb-1 form-label">Password Baru</label>
                                            <input type="password" name="password" id="dz-password" class="form-control"
                                                placeholder="Masukkan password baru">
                                            <span class="show-pass eye">
                                                <i class="fa fa-eye-slash"></i>
                                                <i class="fa fa-eye"></i>
                                            </span>
                                        </div>

                                        <div class="mb-4 position-relative">
                                            <label class="mb-1 form-label">Konfirmasi Password</label>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                placeholder="Konfirmasi password">
                                        </div>

                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary light btn-block">Reset
                                                Password</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('admin/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/toastr/js/toastr.min.js') }}"></script>
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
