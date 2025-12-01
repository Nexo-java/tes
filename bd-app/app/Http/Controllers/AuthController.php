<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userslogin;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'uname' => ['required', 'string'],
            'password' => ['required', 'string']
        ]);
$user = Userslogin::where('uname', $credentials['uname'])->first();
if ($user && $user->password === $credentials ['password']) {
       $request->session()->put('userlogin', Userslogin::all());
        return redirect()->route('siswa.index');
    }

return back()->withErrors(['uname' => 'Username atau password salah.']);
    }
}
