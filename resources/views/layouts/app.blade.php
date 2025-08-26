<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/v/bs5/dt-1.13.8/datatables.min.css">
    <style>
        .pagination .page-link {
            border-radius: 0.375rem;
            margin: 0 2px;
            border: 1px solid #dee2e6;
            color: #6c757d;
            transition: all 0.15s ease-in-out;
        }
        
        .pagination .page-link:hover {
            background-color: #e9ecef;
            border-color: #dee2e6;
            color: #495057;
        }
        
        .pagination .page-item.active .page-link {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: white;
            font-weight: 600;
        }
        
        .pagination .page-item.disabled .page-link {
            background-color: #f8f9fa;
            border-color: #dee2e6;
            color: #adb5bd;
            cursor: not-allowed;
        }
        
        .pagination .page-item.disabled .page-link:hover {
            background-color: #f8f9fa;
            border-color: #dee2e6;
            color: #adb5bd;
        }
        
        .pagination .page-link {
            min-width: 40px;
            text-align: center;
            font-size: 0.875rem;
        }
        
        .pagination .page-item:first-child .page-link,
        .pagination .page-item:last-child .page-link {
            min-width: 80px;
        }
        
        .pagination .page-item .page-link {
            font-weight: 500;
        }
        
        .pagination .page-item.active .page-link {
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }
        
        .pagination .page-link:focus {
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
            outline: none;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <div class="container">
            <a class="navbar-brand" href="{{ route('contacts.index') }}">
                <i class="fas fa-address-book me-2"></i>Contact Manager
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                @unless (request()->routeIs('login'))
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contacts.index') }}">
                            <i class="fas fa-list me-1"></i>Contacts
                        </a>
                    </li>
                    @auth
                        <li class="nav-item ms-lg-3">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-link nav-link p-0" type="submit"><i class="fas fa-sign-out-alt me-1"></i>Logout</button>
                            </form>
                        </li>
                    @endauth
                </ul>
                @endunless
            </div>
        </div>
    </nav>

    <main class="container my-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show auto-dismiss" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show auto-dismiss" role="alert">
                @if($errors->count() === 1)
                    {{ $errors->first() }}
                @else
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.8/datatables.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const alerts = document.querySelectorAll('.auto-dismiss');
            alerts.forEach(function (alertEl) {
                setTimeout(function () {
                    const bsAlert = bootstrap.Alert.getOrCreateInstance(alertEl);
                    bsAlert.close();
                }, 3000);
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
