<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // switch ($request->role) {
        //     case 1:
        //         $request->validate([
        //             'passcode' => ['required', 'string', 'max:255'],
        //         ]);
        //         $user = User::where('passcode' , $request->passcode)
        //             ->update([
        //                 'avatar' => 'default-avatar-user.png',
        //                 'name' => $request->name,
        //                 'email' => $request->email,
        //                 'password' => Hash::make($request->password),
        //             ]);
        //         if (!$user) { 
        //             return back()->with('passcode_err', 'passcode not found.'); 
        //         }
        //         break;
        //     case 2:
        //         break;
        //         default:
        //     }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        
        $user->attachRole('3'); // parameter can be a Role object, array, id or the role string name
        notify('newUser', 'new user', 'Hello there! you have a newly registered user ' . Str::title($user->name) . ' ' . $user->email . '.');

        

        event(new Registered($user));
        return redirect('login'); // my own


        // ---------default from breeze-------------
        // Auth::login($user);
        // return redirect(RouteServiceProvider::HOME);
    }
}
