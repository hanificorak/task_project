

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Harshad Number</title>
    <link href="{{ asset('asset/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5>Check Number</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('checkHarshadNumber') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="col-form-label" id="numberInput">Enter a number</label>
                        <input type="number" class="form-control" placeholder="Enter a number" id="numberInput" name="number" required />
                    </div>

                    <button type="submit" class="btn btn-success float-end mt-2" style="min-width: 120px">Check</button>
                </form>
            </div>
        </div>
    </div>
   
</body>
</html>
