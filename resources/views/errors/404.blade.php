<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Page Not Found</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">404 Page Not Found</div>
                    <div class="card-body">
                        <p>Sorry, the page you are looking for does not exist.</p>
                        <a href="{{ route('home') }}" class="btn btn-primary">Go to Dashboard</a>
                        <a href="{{ route('login') }}" class="btn btn-secondary">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
