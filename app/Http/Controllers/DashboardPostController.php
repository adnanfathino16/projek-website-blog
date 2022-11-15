<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.posts.index', [
            'posts' => Post::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.posts.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Request adalah menangani semua data yang dikirimkan oleh form

        // dump die debug
        //ddd($request);
        // string masuknya ke request
        // file masuknya ke files

        // store mengembalikan pathnya

       $validatedData = $request->validate([
        'title' => 'required|max:255',
        'slug' => 'required|unique:posts',
        'category_id' => 'required',
        // sebelum max harus ditambahkan kata file supaya menandakan bahwa itu file bukan integer
        'image' => 'image|file|max:1024',
        'body' => 'required'
       ]);

       if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('post-image');
       }

       $validatedData['user_id'] = auth()->user()->id;
    //    string helpers(str limit) laravel
    // strip_tags untuk menghilangkan tag html pada form body
       $validatedData['excerpt'] = Str::limit(strip_tags($request->body, 200));

       Post::create($validatedData);

       return redirect('/dashboard/posts')->with('success', 'post baru telah ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('dashboard.posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('dashboard.posts.edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // request itu data baru
        // post itu data lama yang ada didatabase 

        $rules = [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required'
           ];
        
        if($request->slug != $post->slug){
            $rules['slug'] = 'required|unique:posts';
        }

        $validatedData = $request->validate($rules);

        if($request->file('image')){
            // gambar lama dihapus sebelum diupdate
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('post-image');
       }

        // ketika sudah lolos ambil user_id dan excerptnya baru diupdate
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body, 200));

       Post::where('id', $post->id)->update($validatedData);

       return redirect('/dashboard/posts')->with('success', 'post baru telah di update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // menghapus image di folder storage jika menekan tombol delete
        if($post->image){
            Storage::delete($post->image);
        }

        // menghapus ditabel
        // menghapus sesuai idnya 
        Post::destroy($post->id);

        return redirect('/dashboard/posts')->with('success', 'post telah dihapus!');
    }

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
