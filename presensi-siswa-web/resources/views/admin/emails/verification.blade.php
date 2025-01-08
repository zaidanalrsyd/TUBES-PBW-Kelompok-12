<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: #7356f1;
            color: white;
            padding: 30px;
            text-align: center;
        }

        .content {
            padding: 30px;
            background: white;
        }

        .button {
            display: inline-block;
            padding: 12px 30px;
            background: #7356f1;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: 500;
            font-size: 16px;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background: #f8f8f8;
            color: #666;
            font-size: 14px;
        }

        .text-muted {
            color: #6e6e6e;
            font-size: 14px;
        }

        .link-url {
            color: #7356f1;
            word-break: break-all;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Verifikasi Email Anda</h2>
        </div>
        <div class="content">
            <p>Halo {{ $user->name }},</p>

            <p>Selamat datang! Silakan verifikasi alamat email Anda untuk menyelesaikan pendaftaran.</p>

            <div style="text-align: center;">
                <a href="{{ url('/email/verify/' . $user->id . '/' . $hash) }}" class="button">
                    Verifikasi Email
                </a>
            </div>

            <p class="text-muted">Jika Anda mengalami masalah saat mengklik tombol di atas, salin dan tempel URL di
                bawah ini ke browser Anda:</p>
            <p class="link-url">
                {{ url('/email/verify/' . $user->id . '/' . $hash) }}
            </p>

            <p class="text-muted">Link verifikasi ini akan kadaluarsa dalam 60 menit.</p>

            <p>Jika Anda tidak mendaftar akun ini, abaikan email ini.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Seluruh hak cipta dilindungi.</p>
        </div>
    </div>
</body>

</html>
