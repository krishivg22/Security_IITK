<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function create(){
        return view('users.register');
    }
    public function store(Request $request){
        $formFields= $request->validate(['name'=>['required','min:3'],
    'email'=>['required','email',Rule::unique('users','email')],
'password'=>['required','confirmed','min:6']]);
#Now we store hashed passwords.
$formFields['password']=bcrypt($formFields['password']);
$user=User::create($formFields);
#Login and redirect to home.
auth()->login($user);
return redirect('/')->with('message','User Registered Successfully');
    }
    public function logout (Request $request){
auth()->logout();
$request->session()->invalidate();
$request->session ()->regenerateToken ();
return redirect('/')->with ('message', 'You have been
logged out!');
    }
    public function login(){
        return view('users.login');
    }
    public function authenticate(Request $request){
        $formFields= $request->validate(['email'=>['required','email'],
        'password'=>['required']]);
        if(auth()->attempt($formFields)) {         #This not only checks if credentials are correct, but also logs us in.
            $request->session()->regenerate();
            return redirect('/')->with('message', 'You are now
            logged in!');
            }
            return back()->withErrors(['email' => 'Invalid
            Credentials'])->onlyInput('email');   # Shows error only under email section.
    }
}



#auth()->logout();: This line logs the user out using Laravel's authentication system. It terminates the user's authenticated session.
#$request->session()->invalidate();: This invalidates the user's session data. It clears out any existing session data for the user, ensuring they are no longer authenticated or have any previous session-related information.
#$request->session()->regenerateToken();: This line regenerates the CSRF (Cross-Site Request Forgery) token for the session. This token helps protect against cross-site request forgery attacks by generating a new token to be used for subsequent requests, enhancing security.