<!DOCTYPE html>
<html>
<head>
    <title>Staff-Admin User List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div style="text-align: center;">
        <h3>List of Staff and Admin Users</h3>
    </div>
    
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Role</th>
                <th scope="col">Numbers of User/s</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($staffAdminCount as $staffAdminCounts)
                <tr>
                    <td>{{ $staffAdminCounts->role }}</td>
                    <td>{{ $staffAdminCounts->count }}</td>
                </tr>                
            @endforeach
        </tbody>
    </table>
    <br>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">User Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->fname .' '. $user->mname .' '. $user->lname }}</td>>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                </tr>                
            @endforeach
        </tbody>
    </table>
</body>
</html>
