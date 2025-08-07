<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Validation\Rules;
use App\Http\Middleware\RedirectIfAuthenticated;

Route::get('/', function () {
    session(['registration_info' => []]);

    return view('auth.login');
})->middleware(RedirectIfAuthenticated::class)->name('login');

Route::post('/', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials, $request->input('remember'))) {
        $request->session()->regenerate();

        return redirect()->intended('/dashboard');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
});

Route::get('/register', function (Request $request) {
    $sessionData = [];

    if ($request->has('backed') && $request->get('backed')) {
        $sessionData = session('registration_info', []);
    }

    return view('auth.register', compact('sessionData'));
})->middleware(RedirectIfAuthenticated::class);

Route::post('/register', function (Request $request) {
    $request->validate([
        'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
        'first_name' => 'required|max:255',
        'middle_name' => 'max:255',
        'surname' => 'required|max:255',
        'phone_number' => 'required|phone'
    ]);

    session(['registration_info' => $request->all()]);

    return redirect('/register-2');
});

Route::get('/register-2', function () {
    return view('auth.register-2');
})->middleware(RedirectIfAuthenticated::class);

Route::post('/register-2', function (Request $request) {
    $request->validate([
        'name' => 'required|max:255|min:3|unique:' . User::class,
        'password' => ['required', 'confirmed', Rules\Password::min(8)->numbers()],
    ]);

    $sessionData = session('registration_info', []);
    $userFields = array_merge([
        'name' => $request->name,
        'password' => Hash::make($request->password),

    ], $sessionData);

    $user = User::create($userFields);

    Auth::login($user);

    return redirect()->intended('/dashboard');
});

Route::get('/dashboard', function () {
    $user = Auth::user();

    return view('dashboard', compact('user'));
})->middleware('auth');

Route::get('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
})->middleware('auth');
/**
 * APIs
 */
Route::post('/api/v1/check-email', function (Request $request) {
    $email = $request->get('email');
    $foundUser = User::where('email', '=', $email)->first();

    return ['exists' => $foundUser !== NULL];
});

Route::post('/api/v1/check-username', function (Request $request) {
    $username = $request->get('username');
    $foundUser = User::where('name', '=', $username)->first();

    return ['exists' => $foundUser !== NULL];
});