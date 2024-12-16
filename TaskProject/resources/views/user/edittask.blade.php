<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<style>
    :root[data-theme="light"] {
        --bg-color: #f5f5f5;
        --text-color: #333;
        --navbar-color: #4CAF8F;
        --card-bg: #fff;
    }

    :root[data-theme="dark"] {
        --bg-color: #1a1a1a;
        --text-color: #fff;
        --navbar-color: #2d8a6b;
        --card-bg: #2d2d2d;
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
        background-color: #2d8a6b;
    }

    input:checked + .slider:before {
        transform: translateX(26px);
    }
</style>

<body>
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
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col">
                <h2 class="text-center">Edit Task</h2>
            </div>
        </div>

        <!-- Edit Task Form -->
        <form action="{{ route('tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $task->title) }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"
                    required>{{ old('description', $task->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="due_date" class="form-label">Due Date</label>
                <input type="date" class="form-control" id="due_date" name="due_date"
                    value="{{ old('due_date', $task->due_date->format('Y-m-d')) }}" required>
            </div>

            <div class="mb-3">
                <label for="completed" class="form-label">Status</label>
                <select class="form-select" id="completed" name="completed" required>
                    <option value="0" {{ old('completed', $task->completed) == 0 ? 'selected' : '' }}>Pending</option>
                    <option value="1" {{ old('completed', $task->completed) == 1 ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image (Optional)</label>
                <input type="file" class="form-control" id="image" name="image">
                @if ($task->image)
                    <img src="{{ asset('storage/' . $task->image) }}" alt="Current Image" class="img-fluid mt-2"
                        style="max-width: 200px;">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update Task</button>
        </form>
    </div>

    <!-- Bootstrap JS and optional Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

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
</body>

</html>