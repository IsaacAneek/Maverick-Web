<!DOCTYPE html>
<html>

<head>
    <title>Maverick</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>

    <div class="login-container">

        <h1>Maverick</h1>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <label>Username</label>
            <input type="text" name="username" value="{{ old('username') }}">

            <label>Password</label>
            <input type="password" name="password">

            <label>Confirm Password</label>
            <input type="password" name="password_confirmation">

            @if ($errors->any())
                <div class="error">{{ $errors->first() }}</div>
            @endif

            <button type="submit">
                Register
            </button>

        </form>

        <div class="row">
            <a href="{{ route('login') }}">Back to Login</a>
        </div>

    </div>

</body>

</html>