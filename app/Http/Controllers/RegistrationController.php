<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Arr;
class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sessionData = [];

        if ($request->has('backed') && $request->get('backed')) {
            $sessionData = session('registration_info', []);
        }

        return view('auth.register', compact('sessionData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'first_name' => 'required|max:255',
            'middle_name' => 'max:255',
            'surname' => 'required|max:255',
            'phone_number' => 'required|phone'
        ]);

        session(['registration_info' => $request->all()]);

        return redirect('/register-2');
    }

    public function index2()
    {
        $sessionData = session('registration_info', false);

        if (!$sessionData) {
            return redirect('/register');
        }

        $sessionData = Arr::except($sessionData, ['_token']);

        return view('auth.register-2', compact('sessionData'));
    }

    public function register2(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|min:3|unique:' . User::class,
            'password' => ['required', 'confirmed', Rules\Password::min(8)->numbers()],
        ]);

        $sessionData = session('registration_info', []);
        $userFields = array_merge([
            'name' => $request->name,
            'password' => Hash::make($request->password),

        ], $sessionData);

        try {
            User::create($userFields);
            $success = true;
            $redirectTo = route('login');

            return view('auth.register-2', compact('sessionData', 'success', 'redirectTo'));
        } catch (\Exception $e) {
            return back()->withErrors([
                'general' => 'There has been a problem creating your account. If the problem persists, please contact our customer support.',
            ])->onlyInput('name');
        }
    }

    public function checkEmail(Request $request)
    {
        $email = $request->get('email');
        $foundUser = User::where('email', '=', $email)->first();

        return ['exists' => $foundUser !== NULL];
    }

    public function checkUsername(Request $request)
    {
        $username = $request->get('username');
        $foundUser = User::where('name', '=', $username)->first();

        return ['exists' => $foundUser !== NULL];
    }
}
