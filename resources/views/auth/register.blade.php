<div>
    <h1>Register</h1>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div>
            <p>Enter your username</p>
            <input type="text" name="username" required>
        </div>

        <div>
            <p>Enter your email</p>
            <input type="email" name="email" required>
        </div>

        <div>
            <p>Enter your password</p>
            <input type="password" name="password" required>
        </div>

        <div>
            <p>Confirm your password</p>
            <input type="password" name="password_confirmation" required>
        </div>

        <button type="submit">Register</button>
    </form>
</div>