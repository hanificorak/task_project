<!DOCTYPE html>
<html>

<head>
    <title>Factors List</title>
    <link href="{{ asset('asset/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/bootstrap/table/dist/bootstrap-table.min.css') }}" rel="stylesheet">

</head>

<body>

    <div class="container mt-4">
        <h1>Factors List</h1>
        <hr />
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="factorTable">
                <thead>
                    <tr>
                        <th data-width="100" scope="col">#</th>
                        <th scope="col">Factor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($factorPairs as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
<script src="{{ asset('asset/jquery/jquery-3.7.1.min.js') }}" defer></script>
<script src="{{ asset('asset/bootstrap/table/dist/bootstrap-table.min.js') }}" defer></script>
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function(event) {
        $("#factorTable").bootstrapTable({
            height: window.innerHeight - 200,
            locale: 'tr-TR',
            search: true
        })
    });
</script>

</html>
