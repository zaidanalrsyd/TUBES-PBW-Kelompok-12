<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Reset Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            background-color: #f9fafb;
            margin: 0;
            padding: 0;
        }

        .email-wrapper {
            padding: 30px 15px;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .email-header {
            background-color: #4338ca;
            padding: 30px 20px;
            text-align: center;
            color: #ffffff;
        }

        .header-title {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
            color: #ffffff;
        }

        .email-content {
            padding: 40px 30px;
            color: #374151;
        }

        h2 {
            color: #1f2937;
            font-size: 24px;
            font-weight: 600;
            margin: 0 0 20px;
        }

        p {
            margin: 0 0 20px;
            font-size: 16px;
            color: #4b5563;
        }

        .button-container {
            text-align: center;
            margin: 35px 0;
        }

        .reset-button {
            display: inline-block;
            background-color: #4338ca;
            color: #ffffff !important;
            text-decoration: none !important;
            padding: 14px 35px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            transition: background-color 0.2s;
            box-shadow: 0 2px 4px rgba(67, 56, 202, 0.2);
        }

        .time-limit {
            background-color: #f3f4f6;
            border-left: 4px solid #4338ca;
            padding: 15px 20px;
            margin: 25px 0;
            border-radius: 4px;
        }

        .time-limit strong {
            color: #1f2937;
            display: block;
            margin-bottom: 5px;
        }

        .warning-text {
            font-size: 14px;
            color: #6b7280;
            background-color: #fff9f9;
            padding: 15px 20px;
            border-radius: 4px;
            border: 1px solid #fee2e2;
        }

        .email-footer {
            text-align: center;
            padding: 20px 30px;
            background-color: #f9fafb;
            border-top: 1px solid #e5e7eb;
        }

        .email-footer p {
            margin: 5px 0;
            font-size: 14px;
            color: #6b7280;
        }
    </style>
</head>

<body>
    <div class="email-wrapper">
        <div class="email-container">
            <div class="email-header">
                <h1 class="header-title">{{ config('app.name') }}</h1>
            </div>

            <div class="email-content">
                <h2>Halo {{ $user->name }}!</h2>

                <p>Kami menerima permintaan untuk reset password akun Anda di {{ config('app.name') }}.</p>

                <p>Silakan klik tombol di bawah ini untuk melanjutkan proses reset password:</p>

                <div class="button-container">
                    <a href="{{ url('reset-password', $token) }}" class="reset-button">Reset Password</a>
                </div>

                <div class="time-limit">
                    <strong>⚠️ Perhatian</strong>
                    Link reset password ini akan kadaluarsa dalam 60 menit demi keamanan akun Anda.
                </div>

                <div class="warning-text">
                    Jika Anda tidak meminta reset password, abaikan email ini. Password Anda akan tetap aman dan tidak
                    akan berubah.
                </div>
            </div>

            <div class="email-footer">
                <p>Email ini dikirim secara otomatis, mohon tidak membalas.</p>
                <p>{{ config('app.name') }} © {{ date('Y') }}. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>

</html>
