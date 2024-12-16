<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
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
        color: var(--text-color);
        transition: all 0.3s ease;
    }

    .navbar {
        background-color: var(--navbar-color) !important;
    }

    .card {
        background-color: var(--card-bg);
        color: var(--text-color);
    }

    .form-control {
        background-color: var(--card-bg);
        color: var(--text-color);
        border-color: var(--navbar-color);
    }

    .form-control:focus {
        background-color: var(--card-bg);
        color: var(--text-color);
    }

    .theme-switch {
        position: relative;
        display: inline-block;
        margin-left: 10px;
        width: 60px;
        height: 34px;
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

    .btn-primary {
        background-color: var(--navbar-color);
        border: none;
    }

    .btn-primary:hover {
        background-color: #2960a0;
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

<body>
    <div>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">task.fs</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Welcome, {{ $LoggedUserInfo->name }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.logout') }}" class="nav-link text-dark">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </li>
                        <li class="nav-item">
                            <label class="theme-switch">
                                <input type="checkbox" id="theme-toggle">
                                <span class="slider"></span>
                            </label>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Main Container -->
        <livewire:add-task />

    </div><br>
    <!-- Theme Switch Script -->
    <script>
        const themeToggle = document.getElementById('theme-toggle');
        const html = document.documentElement;

        // Check for saved theme preference
        const savedTheme = localStorage.getItem('theme') || 'light';
        html.setAttribute('data-theme', savedTheme);
        themeToggle.checked = savedTheme === 'dark';

        // Theme switch handler
        themeToggle.addEventListener('change', function() {
            if (this.checked) {
                html.setAttribute('data-theme', 'dark');
                localStorage.setItem('theme', 'dark');
            } else {
                html.setAttribute('data-theme', 'light');
                localStorage.setItem('theme', 'light');
            }
        });
    </script>
    <!-- Bootstrap JS and optional Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <div class="footer">
        <p class="mb-0">10122206-farhanfahrezi.s-IF6</p>
    </div>
</body>

</html>