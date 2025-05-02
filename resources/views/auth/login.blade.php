<form method="POST" action="{{ route('login') }}">
    @csrf

    <div>
        <p>Enter your email</p>
        <input type="text" name="email" autocomplete="off"> {{-- Has to be eamil since this is the default for Laravel's auth system --}}
    </div>

    <div>
        <p>Enter your password</p>
        <input type="password" name="password" required>
    </div>

    <button type="submit">Login</button>
</form>
