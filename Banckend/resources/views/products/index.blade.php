<!DOCTYPE html>
<html>

<head>
    <title>Products</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="p-4">

    <h2 class="mb-3">Product Management</h2>

    <!-- Add Button -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">
        Add Product
    </button>

    <a href="{{ route('employees.index') }}" class="btn btn-secondary mb-3">Employee Management</a>

    <!-- Product Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Employee</th>
                <th>Name</th>
                <th>SKU</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Category</th>
                <th>Description</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody id="productTable">
            @foreach ($products as $prod)
                <tr id="row{{ $prod->id }}">
                    <td>{{ $prod->id }}</td>
                    <td>{{ $prod->employee->name }}</td>
                    <td>{{ $prod->name }}</td>
                    <td>{{ $prod->sku }}</td>
                    <td>{{ $prod->price }}</td>
                    <td>{{ $prod->quantity }}</td>
                    <td>{{ $prod->category }}</td>
                    <td>{{ $prod->description }}</td>
                    <td>{{ $prod->status == 1 ? 'Active' : 'Inactive' }}</td>

                    <td>
                        <button class="btn btn-sm btn-warning editBtn" data-id="{{ $prod->id }}">Edit</button>
                        <button class="btn btn-sm btn-danger deleteBtn" data-id="{{ $prod->id }}">Delete</button>
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
                    <h5>Add Product</h5>
                </div>

                <div class="modal-body">

                    <select name="employee_id" class="form-control mb-2" required>
                        <option value="">Select Employee</option>
                        @foreach ($employees as $emp)
                            <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                        @endforeach
                    </select>

                    <input class="form-control mb-2" name="name" placeholder="Product Name" required>
                    <input class="form-control mb-2" name="sku" placeholder="SKU Code" required>
                    <input class="form-control mb-2" name="price" placeholder="Price" required>
                    <input class="form-control mb-2" name="quantity" placeholder="Quantity" required>
                    <input class="form-control mb-2" name="category" placeholder="Category" required>
                    <textarea name="description" class="form-control mb-2" placeholder="Description"></textarea>

                    <select name="status" class="form-control">
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
                    <h5>Edit Product</h5>
                </div>

                <div class="modal-body">

                    <select name="employee_id" id="edit_employee_id" class="form-control mb-2">
                        @foreach ($employees as $emp)
                            <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                        @endforeach
                    </select>

                    <input class="form-control mb-2" name="name" id="edit_name">
                    <input class="form-control mb-2" name="sku" id="edit_sku">
                    <input class="form-control mb-2" name="price" id="edit_price">
                    <input class="form-control mb-2" name="quantity" id="edit_quantity">
                    <input class="form-control mb-2" name="category" id="edit_category">
                    <textarea class="form-control mb-2" name="description" id="edit_description"></textarea>

                    <select name="status" id="edit_status" class="form-control">
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

        /* ---------------------- CREATE ---------------------- */
        $('#createForm').submit(function(e) {
            e.preventDefault();

            $.post("{{ route('products.store') }}", $(this).serialize(), function(res) {
                location.reload();
            });
        });

        /* ---------------------- EDIT ---------------------- */
        $('.editBtn').click(function() {
            let id = $(this).data('id');

            $.post("{{ route('products.action') }}", {
                id: id,
                type: 'edit'
            }, function(prod) {

                $('#edit_id').val(prod.id);
                $('#edit_employee_id').val(prod.employee_id);
                $('#edit_name').val(prod.name);
                $('#edit_sku').val(prod.sku);
                $('#edit_price').val(prod.price);
                $('#edit_quantity').val(prod.quantity);
                $('#edit_category').val(prod.category);
                $('#edit_description').val(prod.description);
                $('#edit_status').val(prod.status);

                $('#editModal').modal('show');
            });
        });

        /* ---------------------- UPDATE ---------------------- */
        $('#updateForm').submit(function(e) {
            e.preventDefault();

            $.post("{{ route('products.action') }}",
                $(this).serialize() + '&type=update',
                function(res) {
                    location.reload();
                }
            );
        });

        /* ---------------------- DELETE ---------------------- */
        $('.deleteBtn').click(function() {
            if (!confirm("Delete this product?")) return;

            $.post("{{ route('products.action') }}", {
                id: $(this).data('id'),
                type: 'delete'
            }, function(res) {
                location.reload();
            });
        });
    </script>

</body>

</html>
