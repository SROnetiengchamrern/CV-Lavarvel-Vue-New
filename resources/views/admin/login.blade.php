<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login — CV</title>
    @vite(['resources/css/app.css'])
    <style>
        .login-page {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 1.5rem;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            background: #fff;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 20px 40px rgba(26, 26, 75, 0.15);
        }
        @media (max-width: 480px) {
            .login-page { padding: 1rem; }
            .login-card { padding: 1.35rem; border-radius: 14px; }
        }
        .login-card h1 {
            margin: 0 0 0.35rem;
            font-family: Outfit, sans-serif;
            color: #1a1a4b;
            font-size: 1.5rem;
        }
        .login-card p {
            margin: 0 0 1.5rem;
            color: #5a5a72;
            font-size: 0.92rem;
        }
        .field {
            margin-bottom: 1rem;
        }
        .field label {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            margin-bottom: 0.35rem;
            color: #1a1a4b;
        }
        .field input {
            width: 100%;
            padding: 0.7rem 0.85rem;
            border: 1px solid #d5d9e4;
            border-radius: 10px;
            font: inherit;
            background: #fff;
            color: #1e1e2f;
            outline: none;
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
        }
        .field input:hover {
            border-color: #b8bfd0;
        }
        .field input:focus,
        .field input:focus-visible {
            outline: none;
            border-color: #7ec8e8;
            box-shadow: 0 0 0 3px rgba(126, 200, 232, 0.35);
        }
        .btn:focus,
        .btn:focus-visible {
            outline: none;
            box-shadow: 0 0 0 3px rgba(126, 200, 232, 0.45);
        }
        .error {
            color: #b42318;
            font-size: 0.85rem;
            margin-top: 0.35rem;
        }
        .btn {
            width: 100%;
            margin-top: 0.5rem;
            padding: 0.8rem;
            border: none;
            border-radius: 999px;
            background: #1a1a4b;
            color: #fff;
            font: inherit;
            font-weight: 700;
            cursor: pointer;
        }
        .back {
            display: block;
            text-align: center;
            margin-top: 1rem;
            color: #5a5a72;
            text-decoration: none;
            font-size: 0.88rem;
        }
    </style>
</head>
<body>
    <div class="login-page">
        <form class="login-card" method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <h1>CV Admin</h1>
            <p>Sign in to edit your curriculum vitae.</p>

            <div class="field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
            </div>

            <button class="btn" type="submit">Sign in</button>
            <a class="back" href="{{ route('cv') }}">← Back to CV</a>
        </form>
    </div>
</body>
</html>
