<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class LoginRegister extends Controller
{
   public function Dashboard()
    {
        return view('dashboard');
    }

    public function Login()
    {
        return view('auth.login');
    }



public function User_login(Request $request)
{
    $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    // Retrieve the user by email
    $user = User::where('email', $request->email)->first();

    if ($user) {
        $pepper = config('PASSWORD_PEPPER'); // Retrieve pepper from config
        $passwordWithPepper = $request->password . $pepper;

        // Verify the password (including salt and pepper)
        if (Hash::check($passwordWithPepper, $user->password)) {
            // Regenerate session to prevent fixation attacks
            $request->session()->regenerate();

            // Redirect to the dashboard
            return redirect()->route('DashboardScreen');
        }
    }

    // Redirect back with an error message if login fails
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
}



    public function Register()
    {
        return view('auth.register');
    }


  public function Registerstore(Request $request)
{
    // Validate the input data from the registration form
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        // Validate password with complexity requirements: minimum 8 characters, 
        // must include mixed case, letters, numbers, symbols, and be uncompromised.
        'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->letters()->numbers()->symbols()->uncompromised()],
    ]);

    // Retrieve the pepper from the environment file. This adds an extra security measure 
    // by appending a secret value (pepper) to the password before hashing.
    $pepper = env('PASSWORD_PEPPER');
    
    // Hash the password using Laravel's built-in Hash::make() function. 
    // Note: You don't need to manually add a salt because Laravel automatically handles salting
    // when it hashes passwords. Laravel's Hash::make() function uses bcrypt (by default), 
    // which includes a randomly generated salt for each password, making it secure.
    $hashedPassword = Hash::make($request->password . $pepper);

    // Create a new user record in the database with the validated data.
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        // Store the hashed password in the database (no need to manually manage salt).
        'password' => $hashedPassword,
    ]);

    // Automatically log the user in after successful registration.
    Auth::login($user);

    // Redirect the user to the dashboard.
    return redirect()->route('DashboardScreen');
}



    public function Logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
   
}
