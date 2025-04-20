{{-- For now the form only GETs a URL --}}
<form method="GET" action="{{ route('pages.workout') }}">
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
