<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Sign In | Wasaaz</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Playfair+Display:wght@500;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <style>
        :root {
            --primary: #111111;
            --light: #faf9f6;
            --accent: #8c8276;
            --secondary: #555555;
            --border: #e8e6e1;
            --white: #ffffff;
            --danger: #b22222;
            --shadow: 0 20px 50px rgba(0, 0, 0, 0.06);
            --transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--light);
            color: var(--primary);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            -webkit-font-smoothing: antialiased;
        }

        .auth-card {
            background: var(--white);
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 460px;
            padding: 56px 42px;
        }

        .brand {
            text-align: center;
            margin-bottom: 36px;
        }

        .brand a {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            font-weight: 700;
            color: var(--primary);
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .brand span {
            font-weight: 400;
            color: var(--accent);
        }

        .brand p {
            margin-top: 8px;
            font-size: 12px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--secondary);
        }

        h1 {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            text-align: center;
        }

        .subtitle {
            text-align: center;
            font-size: 14px;
            color: var(--secondary);
            margin-bottom: 32px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            margin-bottom: 8px;
            color: var(--primary);
        }

        input[type="email"],
        input[type="password"],
        input[type="text"] {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid var(--border);
            background: var(--white);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 14px;
            color: var(--primary);
            outline: none;
            transition: var(--transition);
        }

        input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(17, 17, 17, 0.04);
        }

        input::placeholder {
            color: var(--secondary);
            opacity: 0.6;
        }

        .error {
            display: block;
            margin-top: 6px;
            font-size: 12px;
            color: var(--danger);
        }

        .btn-primary {
            width: 100%;
            padding: 16px;
            background: var(--primary);
            color: var(--white);
            border: none;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            cursor: pointer;
            transition: var(--transition);
            margin-top: 8px;
        }

        .btn-primary:hover {
            background: var(--accent);
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 28px 0;
            color: var(--secondary);
            font-size: 12px;
            letter-spacing: 0.5px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .divider::before { margin-right: 14px; }
        .divider::after { margin-left: 14px; }

        .social-login {
            display: flex;
            justify-content: center;
            gap: 14px;
            margin-bottom: 26px;
        }

        .social-btn {
            width: 46px;
            height: 46px;
            border: 1px solid var(--border);
            background: var(--white);
            color: var(--primary);
            border-radius: 50%;
            display: grid;
            place-items: center;
            cursor: pointer;
            transition: var(--transition);
            font-size: 15px;
        }

        .social-btn:hover {
            background: var(--primary);
            color: var(--white);
            border-color: var(--primary);
        }

        .footer-text {
            text-align: center;
            font-size: 14px;
            color: var(--secondary);
        }

        .footer-text a {
            color: var(--primary);
            font-weight: 700;
            border-bottom: 1px solid transparent;
            transition: var(--transition);
        }

        .footer-text a:hover {
            border-color: var(--primary);
        }

        @media (max-width: 480px) {
            body { padding: 0; }
            .auth-card {
                max-width: 100%;
                min-height: 100vh;
                padding: 48px 24px;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }
            .brand a { font-size: 26px; }
            h1 { font-size: 24px; }
        }
    </style>
</head>
<body>
    <div class="auth-card">
        <div class="brand">
            <a href="{{ route('home.new') }}">WASA<span>AZ</span></a>
            <p>Premium curated essentials</p>
        </div>

        <h1>Welcome back</h1>
        <p class="subtitle">Sign in to access your account</p>

        <form action="{{ route('user.login') }}" method="POST" autocomplete="off">
            @csrf

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required />
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required />
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-primary">Sign In</button>
        </form>

        <div class="divider">or continue with</div>

        <div class="social-login">
            <button type="button" class="social-btn" aria-label="Sign in with Google">
                <i class="fab fa-google"></i>
            </button>
            <button type="button" class="social-btn" aria-label="Sign in with Apple">
                <i class="fab fa-apple"></i>
            </button>
            <button type="button" class="social-btn" aria-label="Sign in with Facebook">
                <i class="fab fa-facebook-f"></i>
            </button>
        </div>

        <p class="footer-text">
            Don't have an account? <a href="{{ route('user.showregisterform') }}">Create one</a>
        </p>
    </div>
</body>
</html>
