<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Register</title>

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
            <h3 class="text-center mb-4">Registration</h3>
            <form action="{{ route('Register.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="text" class="form-control @error('name') is-invalid  @enderror"
                        placeholder="Enter your name" name="name" id="name" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control @error('email') is-invalid  @enderror"
                        placeholder="Enter your email" name="email" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        placeholder="Create password" name="password" value="{{ old('password') }}">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <div class="progress mt-2" style="height: 10px;">
                        <div id="password-strength-bar" class="progress-bar" role="progressbar" style="width: 0%;">
                        </div>
                    </div>
                    <small id="password-strength-text" class="form-text mt-1"></small>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control @error('password_confirmation') @enderror"
                        placeholder="password_confirmation" name="password_confirmation">
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div id="password-strength" class="mt-2"></div> <!-- Password strength meter -->
                </div>
              
                <button type="submit" class="btn btn-primary w-100">Register Now</button>
            </form>
            <p class="text-center mt-3">Already have an account? <a href="{{ route('LoginScreen') }}">Login now</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script>
    document.getElementById('password').addEventListener('input', function() {
        const password = this.value;
        const strengthBar = document.getElementById('password-strength-bar');
        const strengthText = document.getElementById('password-strength-text');
        const strength = calculatePasswordStrength(password);

        updatePasswordStrengthUI(strength, strengthBar, strengthText);
    });

    function calculatePasswordStrength(password) {
        let strength = 0;
        if (password.length >= 8) strength++; // Check for length
        if (/[A-Z]/.test(password)) strength++; // Check for uppercase letters
        if (/[a-z]/.test(password)) strength++; // Check for lowercase letters
        if (/[0-9]/.test(password)) strength++; // Check for numbers
        if (/[\W]/.test(password)) strength++; // Check for special characters
        return strength;
    }

    function updatePasswordStrengthUI(strength, strengthBar, strengthText) {
        let strengthLevel = 'Poor';
        let barWidth = '0%';
        let barColor = 'red';

        // Assign strength level, width, and color based on the strength score
        if (strength >= 4) {
            strengthLevel = 'Strong';
            barWidth = '100%';
            barColor = 'green';
        } else if (strength >= 2) {
            strengthLevel = 'Medium';
            barWidth = '66%';
            barColor = 'orange';
        } else {
            strengthLevel = 'Poor';
            barWidth = '33%';
            barColor = 'red';
        }

        // Update the strength bar and text
        strengthBar.style.width = barWidth;
        strengthBar.style.backgroundColor = barColor;
        strengthText.textContent = strengthLevel;
    }
</script>

</html>
