<!DOCTYPE html>
<html>

<head>
    <title>Employee Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-5">

    <div class="container">

        <h2 class="mb-4">Employee Details</h2>

        <div class="card">
            <div class="card-body">

                <p><strong>ID:</strong> {{ $employee->id }}</p>
                <p><strong>Name:</strong> {{ $employee->name }}</p>
                <p><strong>Email:</strong> {{ $employee->email }}</p>
                <p><strong>Phone:</strong> {{ $employee->phone }}</p>
                <p><strong>Position:</strong> {{ $employee->position }}</p>
                <p><strong>Salary:</strong> {{ $employee->salary }}</p>
                <p><strong>Status:</strong> {{ $employee->status == 1 ? 'Active' : 'Inactive' }}</p>

                <!-- BARCODE ONLY -->
                <p><strong>Employee Barcode:</strong></p>
                <div>
                    {!! $barcode->getBarcodeHTML($employee->id, 'C39') !!}
                </div>
                 <div>
                    {!! $barcode2->getBarcodeHTML((string) $employee->id, 'QRCODE') !!}
                </div>


                <a href="{{ route('employees.index') }}" class="btn btn-secondary mt-3">Back</a>
            </div>
        </div>

    </div>

</body>

</html>
