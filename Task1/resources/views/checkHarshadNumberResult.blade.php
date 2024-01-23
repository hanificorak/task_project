<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Number</title>
    <link href="{{ asset('asset/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5>Number Result</h5>
            </div>
            <div class="card-body text-center">
                <div class="alert alert-success text-center p-2 pb-0">
                    <p>The number {{ $number }} is {{ $result }}.</p>
                </div>

                <a href="{{ route('checkHarshadForm') }}">
                    <button type="button" class="btn btn-primary btn-sm" style="min-width: 120px">Back</button>
                </a>
            </div>
        </div>
    </div>

</body>

</html>
