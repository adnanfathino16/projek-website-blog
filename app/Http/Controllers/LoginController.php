<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// paggil method auth
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login.index', [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required|min:5'
        ]);

        if(Auth::attempt($credentials)){
            // session regenerate digunakan untuk menghindari sebuah teknik hacking yang namanya session fixation
            // Jika otentikasi berhasil, Anda harus membuat ulang sesi pengguna untuk mencegah fiksasi sesi
            $request->session()->regenerate(); 
            // sebelum ke (/dashboard) harus melalui intended untuk melewati middleware
            return redirect('/dashboard');
        }

        //jika false balik ke halaman login sambil mengirimkan pesan errornya
        return back()->with('loginError', 'Login failed!');
    }

    public function logout(Request $request){
        Auth::logout();
 
        // invalid sesinya agar tidak bisa dipakai
        $request->session()->invalidate();
        
        // dan bikin baru supaya tidak bisa dibajak
        $request->session()->regenerateToken();
    
        return redirect('/');
    }


}
