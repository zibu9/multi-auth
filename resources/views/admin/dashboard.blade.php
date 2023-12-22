<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <h2>Welcome to Admin Dashboard</h2>

    @if(Auth::guard('admin')->check())
        <p>Hello, {{ Auth::guard('admin')->user()->name }}!</p>
        <p>Email: {{ Auth::guard('admin')->user()->email }}</p>
        <!-- Autres informations de l'utilisateur -->
    @else
        <p>User not authenticated</p>
    @endif
</body>
</html>

