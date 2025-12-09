<!DOCTYPE html>
<html>

<head>
    <title>Employees</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="p-4">

    <h2 class="mb-3">Employee Management</h2>

    <!-- Add Button -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">Add Employee</button>


    <a href="{{ route('products.index') }}" class="btn btn-secondary mb-3">Product Management</a>
    <!-- Employee Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Position</th>
                <th>Salary</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="employeeTable">
            @foreach ($employees as $emp)
                <tr id="row{{ $emp->id }}">
                    <td>{{ $emp->id }}</td>
                    <td>{{ $emp->name }}</td>
                    <td>{{ $emp->email }}</td>
                    <td>{{ $emp->phone }}</td>
                    <td>{{ $emp->position }}</td>
                    <td>{{ $emp->salary }}</td>
                    <td>{{ $emp->status == 1 ? 'Active' : 'Inactive' }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning editBtn" data-id="{{ $emp->id }}">Edit</button>
                        <button class="btn btn-sm btn-danger deleteBtn" data-id="{{ $emp->id }}">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- CREATE MODAL -->
    <div class="modal fade" id="createModal">
        <div class="modal-dialog">
            <form id="createForm" class="modal-content">
                <div class="modal-header">
                    <h5>Add Employee</h5>
                </div>

                <div class="modal-body">
                    <input class="form-control mb-2" name="name" placeholder="Name" required>
                    <input class="form-control mb-2" name="email" placeholder="Email" required>
                    <input class="form-control mb-2" name="phone" placeholder="Phone">
                    <input class="form-control mb-2" name="position" placeholder="Position" required>
                    <input class="form-control mb-2" name="salary" placeholder="Salary" required>
                    <select name="status" class="form-control mb-2">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-success" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- EDIT MODAL -->
    <div class="modal fade" id="editModal">
        <div class="modal-dialog">
            <form id="updateForm" class="modal-content">
                <input type="hidden" name="id" id="edit_id">

                <div class="modal-header">
                    <h5>Edit Employee</h5>
                </div>

                <div class="modal-body">
                    <input class="form-control mb-2" name="name" id="edit_name">
                    <input class="form-control mb-2" name="email" id="edit_email">
                    <input class="form-control mb-2" name="phone" id="edit_phone">
                    <input class="form-control mb-2" name="position" id="edit_position">
                    <input class="form-control mb-2" name="salary" id="edit_salary">
                    <select name="status" id="edit_status" class="form-control mb-2">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // CREATE
        $('#createForm').submit(function(e) {
            e.preventDefault();
            $.post("{{ route('employees.store') }}", $(this).serialize(), function(res) {
                location.reload();
            });
        });

        // EDIT BUTTON CLICK
        $('.editBtn').click(function() {
            let id = $(this).data('id');

            $.post("{{ route('employees.action') }}", {
                id: id,
                type: 'edit'
            }, function(emp) {
                $('#edit_id').val(emp.id);
                $('#edit_name').val(emp.name);
                $('#edit_email').val(emp.email);
                $('#edit_phone').val(emp.phone);
                $('#edit_position').val(emp.position);
                $('#edit_salary').val(emp.salary);
                $('#edit_status').val(emp.status);
                $('#editModal').modal('show');
            });
        });

        // UPDATE 
        $('#updateForm').submit(function(e) {
            e.preventDefault();

            $.post("{{ route('employees.action') }}",
                $(this).serialize() + '&type=update',
                function(res) {
                    location.reload();
                }
            );
        });

        // DELETE 
        $('.deleteBtn').click(function() {
            if (!confirm("Delete this employee?")) return;

            $.post("{{ route('employees.action') }}", {
                id: $(this).data('id'),
                type: 'delete'
            }, function(res) {
                location.reload();
            });
        });
    </script>

</body>

</html>
