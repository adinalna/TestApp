<!DOCTYPE html>
<html>

<head>
    <title>Table Example</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>

<body>
    <div class="container">
        <h1>Create New User</h1>
        <form method="POST" action="/users/add" class="form">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Create User</button>
        </form>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <button type="button" class="btn btn-primary edit-user-button"
                                data-user-id="{{ $user->id }}">Edit</button>
                            <button type="button" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Include Bootstrap JavaScript -->
    <script src="{{ mix('js/app.js') }}"></script>

    <script>
        // JavaScript to handle edit button
        $('.edit-user-button').on('click', function() {
            const userId = $(this).data('user-id');
            const userName = $(this).closest('tr').find('td:eq(1)').text();
            const userEmail = $(this).closest('tr').find('td:eq(2)').text();

            // Populate the form fields with user's information
            $('input[name="name"]').val(userName);
            $('input[name="email"]').val(userEmail);

            // Set the form action to the specific user's update route
            $('form.form').attr('action', `/users/edit/${userId}`);
        });
    </script>
</body>
</html>
