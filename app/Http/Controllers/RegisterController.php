<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index',[
            'title' => 'Register',
            'active' => 'register'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            // wajib diisi|max 255 karakter
            'name' => 'required|max:255', //cara 1 dengan |
            // wajib diisi, minimal 3 karakter, maximal 255, harus unik dari tabel users
            'username' => ['required', 'min:3', 'max:255', 'unique:users'], //cara 2 dengan array
            // wajib diisi | typenya harus email : dns supaya sesuai domainnya| harus unik dari tabel users
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
        ]);

        // passwordnya kita enkripsi terlebih dahulu 
        // $validatedData['password'] = bcrypt($validatedData['password']);

        // cara 2 dengan menggunakan method hash tetapi filenya harus dipanggil dulu
        $validatedData['password'] = Hash::make($validatedData['password']);

        // mengisi ke database menggunakan model user
        User::create($validatedData);

        // flash message setelah registrasi berhasil
        // $request->session()->flash('success', 'Registration successfull! please login');
        
        // memakai session agar lebih ringkas
        // setelah isi tabel redirect ke halaman login
        return redirect('/login')->with('success', 'Registration successfull! please login');
    }
}
