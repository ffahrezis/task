<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root[data-theme="light"] {
            --bg-color: #f5f5f5;
            --text-color: #333;
            --navbar-color: #4CAF8F;
            --card-bg: #fff;
            --input-bg: #fff;
            --input-border: #ced4da;
            --footer-text: #333;
        }

        :root[data-theme="dark"] {
            --bg-color: #1a1a1a;
            --text-color: #fff;
            --navbar-color: #3475b9;
            --card-bg: #2d2d2d;
            --input-bg: #333;
            --input-border: #404040;
            --footer-text: #ffffff;
        }

        body {
            background-color: var(--bg-color);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            display: flex;
            background: var(--card-bg);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 900px;
            height: 500px;
        }

        .login-form {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: var(--text-color);
        }

        .status-section {
            flex: 1;
            background-color: var(--navbar-color);
            padding: 20px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .status-section::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='50' cy='50' r='40' fill='rgba(255,255,255,0.1)'/%3E%3C/svg%3E") repeat;
            opacity: 0.1;
        }

        .logo {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 2rem;
            color: var(--text-color);
        }

        .form-title {
            font-size: 1.5rem;
            font-weight: 500;
            margin-bottom: 2rem;
            color: var(--text-color);
        }

        .form-control {
            background-color: var(--input-bg);
            color: var(--text-color);
            border: none;
            border-bottom: 1px solid var(--input-border);
            border-radius: 0;
            padding: 0.5rem 0;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background-color: var(--input-bg);
            color: var(--text-color);
            border-color: var(--navbar-color);
            box-shadow: 0 0 0 0.25rem rgba(76, 175, 143, 0.25);
        }

        .form-control:hover {
            border-color: var(--navbar-color);
        }

        .btn-sign-up {
            background-color: var(--navbar-color);
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            width: 100%;
            margin-top: 1rem;
        }

        .btn-sign-up:hover {
            background-color: #2960a0;
            transition: background-color 0.2s ease;
        }

        .login-link {
            text-align: center;
            margin-top: 1rem;
        }

        .login-link a {
            color: var(--navbar-color);
            text-decoration: none;
        }

        .login-link a:hover {
            color: #2960a0;
            text-decoration: underline;
        }

        .status-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        .status-image {
            width: 300px;
            height: auto;
            object-fit: contain;
        }

        .theme-switch {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 60px;
            height: 34px;
            z-index: 1000;
        }

        .theme-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: #3475b9;
        }

        input:checked + .slider:before {
            transform: translateX(26px);
        }

        .alert {
            background-color: var(--card-bg);
            color: var(--text-color);
            border-color: var(--input-border);
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 10px 0;
            text-align: center;
            color: var(--footer-text);
            z-index: 1000;
        }
    </style>
</head>

<body>
    <!-- Theme Switch -->
    <label class="theme-switch">
        <input type="checkbox" id="theme-toggle">
        <span class="slider"></span>
    </label>

    <div class="login-container">
        <div class="login-form">
            <div class="logo">task.fs</div>
            <div class="form-title">Create Your Account</div>

            <form action="{{ route('user.save') }}" method="post">
                @csrf
                <div class="results">
                    @if(Session::get('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                    @endif

                    @if(Session::get('fail'))
                    <div class="alert alert-danger">
                        {{ Session::get('fail') }}
                    </div>
                    @endif
                </div>

                <div class="mb-3">
                    <input type="text" class="form-control" name="name" placeholder="Enter full name"
                        value="{{ old('name') }}">
                    <span class="text-danger">@error('name'){{ $message }} @enderror</span>
                </div>

                <div class="mb-3">
                    <input type="text" class="form-control" name="email" placeholder="Enter email"
                        value="{{ old('email') }}">
                    <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                </div>

                <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Enter password">
                    <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                </div>

                <button type="submit" class="btn-sign-up">Sign Up</button>
            </form>

            <div class="login-link">
                Already have an account? <a href="{{ route('user.login') }}">Login here</a>
            </div>
        </div>

        <div class="status-section">
            <div class="status-content">
                <img src="/images/anime-day.jpg" alt="Theme Illustration" class="status-image" id="theme-image">
            </div>
        </div>
    </div>

    <!-- Theme Switch Script -->
    <script>
        const themeToggle = document.getElementById('theme-toggle');
        const html = document.documentElement;
        const themeImage = document.getElementById('theme-image');

        // Check for saved theme preference
        const savedTheme = localStorage.getItem('theme') || 'light';
        html.setAttribute('data-theme', savedTheme);
        themeToggle.checked = savedTheme === 'dark';
        themeImage.src = savedTheme === 'dark' ? '/images/anime-night.jpg' : '/images/anime-day.jpg';

        // Theme switch handler
        themeToggle.addEventListener('change', function() {
            if (this.checked) {
                html.setAttribute('data-theme', 'dark');
                localStorage.setItem('theme', 'dark');
                themeImage.src = '/images/anime-night.jpg';
            } else {
                html.setAttribute('data-theme', 'light');
                localStorage.setItem('theme', 'light');
                themeImage.src = '/images/anime-day.jpg';
            }
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Footer -->
    <div class="footer">
        <p class="mb-0">10122206-farhanfahrezi.s-IF6</p>
    </div>
</body>
</html>