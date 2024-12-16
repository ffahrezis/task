<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<style>
    :root[data-theme="light"] {
        --bg-color: #f5f5f5;
        --text-color: #333;
        --navbar-color: #4CAF8F;
        --card-bg: #fff;
        --table-header: #4CAF8F;
        --table-border: #dee2e6;
        --footer-text: #333;
    }

    :root[data-theme="dark"] {
        --bg-color: #1a1a1a;
        --text-color: #fff;
        --navbar-color: #3475b9;
        --card-bg: #2d2d2d;
        --table-header: #3475b9;
        --table-border: #404040;
        --footer-text: #ffffff;
    }

    body {
        background-color: var(--bg-color);
        min-height: 100vh;
        padding: 20px;
        padding-bottom: 60px;
        position: relative;
        background-image: url('/images/anime-study.jpg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        transition: background-image 0.3s ease;
    }

    body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: var(--bg-color);
        opacity: 0.85;
        z-index: -1;
    }

    .navbar {
        background-color: var(--navbar-color) !important;
    }

    .container {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 20px;
        margin-top: 20px;
    }

    .table {
        color: var(--text-color);
        border-color: var(--table-border);
    }

    .table thead th {
        background-color: var(--table-header);
        color: white;
    }

    .table-bordered {
        border-color: var(--table-border);
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0, 0, 0, 0.05);
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

    .form-control, .form-select {
        background-color: var(--card-bg);
        color: var(--text-color);
        border-color: var(--table-border);
    }

    .form-control:focus, .form-select:focus {
        background-color: var(--card-bg);
        color: var(--text-color);
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

    .btn-primary {
        background-color: var(--navbar-color);
        border: none;
    }

    .btn-primary:hover {
        background-color: #2960a0;
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
                        <label class="theme-switch">
                            <input type="checkbox" id="theme-toggle">
                            <span class="slider"></span>
                        </label>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.logout') }}" class="nav-link text-dark">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="container mt-5">
        <div class="row mb-4">

            <!-- Adjusted column for button alignment -->
            <div class="col text-end mb-4">
                <a href="{{ route('user.addtasks') }}" class="btn btn-warning">Add Task</a>
            </div>
        </div>


        <!-- Filters Section -->
        <div class="row mb-4">
            <div class="col-md-4">
                <label for="filterStatus" class="form-label">Filter by Status</label>
                <select class="form-select" id="filterStatus" onchange="filterTasks()">
                    <option value="all">All</option>
                    <option value="completed">Completed </option>
                    <option value="pending">Pending </option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="filterDueDate" class="form-label">Filter by Due Date</label>
                <select class="form-select" id="filterDueDate" onchange="filterTasks()">
                    <option value="">All Dates</option>
                    <option value="today">Today</option>
                    <option value="tomorrow">Tomorrow</option>
                    <option value="next7days">Next 7 Days</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="searchTask" class="form-label">Search by Title</label>
                <input type="text" class="form-control" id="searchTask" onkeyup="filterTasks()"
                    placeholder="Search tasks...">
            </div>
        </div>

        <!-- Tasks Table -->
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-striped" id="tasksTable">
                    <thead rounded style="background-color: var(--table-header); border-radius: 0.5rem; color:white">
                        <tr>
                            <th scope="col"><i class="fas fa-image"></i> Image</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Due Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tasksBody">
                        @if($tasks && $tasks->count())
                            @foreach($tasks as $task)
                                <tr>
                                    <td>
                                        @if($task->image)
                                            <img src="{{ asset('storage/' . $task->image) }}" alt="{{ $task->title }}"
                                                class="img-thumbnail" style="max-width: 100px; height: auto; cursor: pointer"
                                                onclick="window.open(this.src)">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td>{{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}</td>
                                    <td class="task-status">{{ $task->completed ? 'Completed  ' : 'Pending  ' }}</td>
                                    <td>
                                        <a href="{{ route('tasks.show', ['id' => $task->id]) }}"
                                            class="btn btn-sm btn-info" title="View">
                                            <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9ImN1cnJlbnRDb2xvciIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiPjxyZWN0IHg9IjIiIHk9IjIiIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgcng9IjIiIHJ5PSIyIi8+PHBhdGggZD0iTTcgMTJoMTAiLz48cGF0aCBkPSJNNyA4aDEwIi8+PHBhdGggZD0iTTcgMTZoMTAiLz48L3N2Zz4=" alt="View" width="16" height="16" style="filter: invert(1);">
                                        </a>
                                        <a href="{{ route('tasks.edit', $task->id) }}" 
                                            class="btn btn-sm btn-warning" title="Edit">
                                            <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9ImN1cnJlbnRDb2xvciIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiPjxwYXRoIGQ9Ik0xNyAzYTIuODI4IDIuODI4IDAgMSAxIDQgNEw3LjUgMjAuNSAyIDIybDEuNS01LjVMMTcgM3oiLz48L3N2Zz4=" alt="Edit" width="16" height="16" style="filter: invert(1);">
                                        </a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9ImN1cnJlbnRDb2xvciIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiPjxwYXRoIGQ9Ik0zIDZoMThNMTkgNnYxNGEyIDIgMCAwIDEtMiAySDdhMiAyIDAgMCAxLTItMlY2bTMtM2g2TTEwIDExdjZNMTQgMTF2NiIvPjwvc3ZnPg==" alt="Delete" width="16" height="16" style="filter: invert(1);">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">No tasks found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS and optional Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Filtering and Searching Script -->
    <script>
        function filterTasks() {
            const statusFilter = document.getElementById('filterStatus').value.toLowerCase();
            const dueDateFilter = document.getElementById('filterDueDate').value.toLowerCase();
            const searchFilter = document.getElementById('searchTask').value.toLowerCase();
            const rows = document.querySelectorAll('#tasksBody tr');

            rows.forEach(row => {
                const status = row.querySelector('.task-status').innerText.toLowerCase();
                const dueDate = row.cells[3].innerText.toLowerCase();
                const title = row.cells[1].innerText.toLowerCase();

                let statusMatch = (statusFilter === 'all' || status.includes(statusFilter));
                let dateMatch = filterDueDate(dueDate, dueDateFilter);
                let searchMatch = (title.includes(searchFilter));

                if (statusMatch && dateMatch && searchMatch) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function filterDueDate(dueDate, filter) {
            const today = new Date();
            const taskDate = new Date(dueDate);

            if (filter === 'today') {
                return today.toDateString() === taskDate.toDateString();
            } else if (filter === 'tomorrow') {
                let tomorrow = new Date(today);
                tomorrow.setDate(today.getDate() + 1);
                return tomorrow.toDateString() === taskDate.toDateString();
            } else if (filter === 'next7days') {
                let nextWeek = new Date(today);
                nextWeek.setDate(today.getDate() + 7);
                return taskDate >= today && taskDate <= nextWeek;
            }
            return true; // Show all if no filter is selected
        }
    </script>

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
<!-- Footer -->
<footer class="footer">
    <p class="mb-0">10122206-farhanfahrezi.s-IF6</p>
</footer>

</html>