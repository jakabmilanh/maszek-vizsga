<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
{

    $request->validate([
        'username' => ['required', 'string', 'max:50', 'unique:users'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'confirmed'],
        'telephone' => ['required', 'string', 'max:20'],
        'role' => ['required', 'in:Munkáltató,Munkavállaló'],
        'profile_picture' => ['nullable', 'image', 'max:2048'],
        'profession_pictures' => ['nullable', 'array'],
        'bio' => ['nullable', 'string'],
    ]);

    $profilePicturePath = null;
    if ($request->hasFile('profile_picture')) {
        $profilePicturePath = $request->file('profile_picture')->store('images/profile_pictures', 'public');
    }

    $professionPicturesPaths = [];
    if ($request->hasFile('profession_pictures')) {
        foreach ($request->file('profession_pictures') as $file) {
            $professionPicturesPaths[] = $file->store('images/profession_pictures', 'public');
        }
    }
    $user = User::create([
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'telephone' => $request->telephone,
        'role' => $request->role,
        'profile_picture' => $profilePicturePath,
        'profession_pictures' => json_encode($professionPicturesPaths),
        'bio' => $request->bio,
    ]);

    event(new Registered($user));

    Auth::login($user);

    return redirect(route('home'));
}
}
