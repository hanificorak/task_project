<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home App</title>
    <link href="{{ asset('asset/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

</head>

<body>
    <div class="container mt-5 text-center">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('factors') }}">
                    <button type="button" class="btn btn-outline-primary" style="min-width: 120px">Factors (Task 1.1)</button>
                </a>
                <hr />
                <a href="{{ route('numberForm') }}">
                    <button type="button" class="btn btn-outline-primary" style="min-width: 120px">Number Check (Task 1.2)</button>
                </a>
                <hr />
                <a href="{{ route('checkHarshadForm') }}">
                    <button type="button" class="btn btn-outline-primary" style="min-width: 120px">Harshad Check (Task 1.3)</button>
                </a>
            </div>
        </div>
    </div>

</body>

</html>
