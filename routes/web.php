<?php

use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminUserController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardPostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home', [
        "title" => "Home",
        "active" => "home"
    ]);
});

Route::get('/about', function () {
    return view('about', [
        "title" => "About",
        "active" => "about",
        "nama" => "Adnan Fathino",
        "email" => "fathinoadnan@gmail.com",
        "gambar" => "Adnan.jpeg"
    ]);
});

// halaman index posts
Route::get('/posts',[PostController::class,'index']);
// halaman single post
Route::get('/posts/{post:slug}', [PostController::class, 'show']);

Route::get('/categories', function(){
    return view('categories',[
        'title' => 'Post Categories',
        "active" => "categories",
        'categories' => Category::all()
    ]);
});
// http/providers/routesseviceprovider
// http/middleware/authenticate untuk menulis syntax name('login')
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', function(){
    return view('dashboard.index');
})->middleware('auth');

Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');

Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show')->middleware('admin');
Route::resource('dashboard/users', AdminUserController::class)->except(['show','create','edit','update','store'])->middleware('admin');
                          // sudah tidak dipakai karena pindah ke route posts
// Route::get('/categories/{category:slug}', function(Category $category){
//     return view('posts',[
//         'title' => "Post by Category : $category->name",
//         "active" => "posts",
//         'posts' => $category->posts->load('author','category' )
//     ]);
// });

// Route::get('/authors/{author:username}', function(User $author){
//     return view('posts',[
//         'title' => "Post By Author : $author->name",
//         'active' => "posts",
//         'posts' => $author->posts->load('author','category' )
//     ]);
// });
