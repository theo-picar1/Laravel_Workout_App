<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forged Gym</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="main-pages">
    @yield('content')

    <footer>
        <div>
            <img src="{{ asset('images/profile-icon.png') }}">
            <p>Profile</p>
        </div>
        <div>
            <img src="{{ asset('images/globe-icon.png') }}">
            <p>Discover</p>
        </div>
        <div>
            <img src="{{ asset('images/add-icon.png') }}">
            <p>Workout</p>
        </div>
        <div>
            <img src="{{ asset('images/weight-icon.png') }}">
            <p>Exercises</p>
        </div>
        <div>
            <img src="{{ asset('images/history-icon.png') }}">
            <p>History</p>
        </div>
    </footer>
</body>
</html>
