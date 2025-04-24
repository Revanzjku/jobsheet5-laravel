<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #f8f9fc;
            --accent-color: #2e59d9;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .form-card {
            border-radius: 0.5rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            border: none;
        }
        
        .form-header {
            background-color: var(--primary-color);
            color: white;
            border-radius: 0.5rem 0.5rem 0 0 !important;
            padding: 1rem 1.5rem;
        }
        
        .form-body {
            padding: 2rem;
        }
        
        .form-label {
            font-weight: 600;
            color: #5a5c69;
        }
        
        .form-control {
            border-radius: 0.375rem;
            padding: 0.5rem 1rem;
            border: 1px solid #d1d3e2;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
        }
        
        .btn-success {
            min-width: 120px;
        }
        
        .btn-secondary {
            min-width: 120px;
        }
        
        .form-section {
            margin-bottom: 1.5rem;
        }
        
        .form-title {
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-card">
                    <div class="form-header">
                        @if (Route::is(['student.create', 'student.edit']))
                            <h2 class="form-title"><i class="bi bi-person-vcard"></i> {{ $title }}</h2>
                        @elseif(Route::is(['classroom.create', 'classroom.edit']))
                            <h2 class="form-title"><i class="bi bi-journal-plus"></i> {{ $title }}</h2>
                        @elseif(Route::is(['studentParent.create', 'studentParent.edit']))
                            <h2 class="form-title"><i class="bi bi-person-video3"></i> {{ $title }}</h2> 
                        @endif
                    </div>
                    <div class="form-body">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
