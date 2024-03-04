<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 Forbidden</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">


            <div>
                <div class="text-center">
                    <div>
                        <img src="{{ asset('img/logo.png') }}" class="img-fluid w-50" />
                    </div>  
                </div>

                <div class="card-body col-md-4 mx-auto mt-5 shadow">
                    <div>
                        <div class="card text-center">
                            <div class="card-header marsman-bg-color-semidark text-white txt-5">Forbidden Page</div>
                            <div class="card-body">
                                <p>Sorry, you don't have permission to access this page.</p>
                                <a href="{{ route('login') }}" class="btn btn-primary">Go Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</body>
</html>
