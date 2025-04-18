<div>
    <h1>Login</h1>

    <form method="POST">
        @csrf
        <div>
            <p>Enter your email or username</p>
            <input type="text" name="emailOrUsername" required>
        </div>

        <div>
            <p>Enter your password</p>
            <input type="password" name="password" required>
        </div>

        <button type="submit">Login</button>
    </form>
</div>
