<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Login</title>

    <style>
        body {
            background-color: #346beb;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .card {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #346beb;
            border: none;
        }

        .btn-primary:hover {
            background-color: #2851a3;
        }

        .form-check-label {
            margin-left: 10px;
        }

        .card a {
            color: #346beb;
            text-decoration: none;
        }

        .card a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card p-4">
            <h3 class="text-center mb-4">Login</h3>
            <form action="{{ route('Login.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="email" value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid 
                        
                    @enderror"
                        placeholder="Email" name="email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <input type="password"
                        class="form-control @error('password') is-invalid
                        
                    @enderror"
                        placeholder="password" name="password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <button type="submit" class="btn btn-primary w-100">Login Now</button>
            </form>
            <p class="text-center mt-3">Already have an account? <a href="{{ route('RegisterScreen') }}">Register
                    now</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
