<!DOCTYPE html>
<html lang="en">
<head>
    <title>Subscribers</title>
    <meta charset="utf-8">
</head>
<body>
    <div class="container-fluid">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Country</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->country }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
