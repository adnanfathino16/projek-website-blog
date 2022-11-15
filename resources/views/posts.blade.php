@extends('layouts.main')

@section('container')
<div class="container">
    <h1 class="mb-3 text-center">{{ $title }}</h1>

    <div class="row justify-content-center mb-3">
      <div class="col-md-6">
        <form action="/posts" method="GET">
          @if(request('category'))
            <input type="hidden" name="category" value="{{ request('category') }}">
          @endif
          @if(request('author'))
            <input type="hidden" name="author" value="{{ request('author') }}">
          @endif
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search.." name="search" value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Search</button>
          </div> 
        </form>
      </div>
    </div>



    {{--  menghitung data seluruh posts ada atau apakah lebih dari 0  --}}
    @if($posts->count())

    <div class="card mb-3">
        {{--  pengkondisian jika ada gambar pada database maka tampilkan ini  --}}
        @if($posts[0]->image)
        {{--  asset storage didapat dari folder public aplikasi kita. tidak usah pakai nama folder post-image karena sudah pada isi database field image dan tidak perlu menaruh folder public kedalam path asset--}}
          <div style="max-height: 400px; overflow:hidden">
              <img src="{{ asset('storage/' . $posts[0]->image) }}" alt="{{ $posts[0]->category->name }}" class="img-fluid">
          </div>  
        {{--  jika tidak ada maka tampilkan ini  --}}
        @else
        {{--  gambar dapat dari API unsplash  --}}
        {{--  $post[0] adalah post an yang terakhir dengan index 0 karena data array collect  --}}
          <img src="https://source.unsplash.com/1200x400?{{ $posts[0]->category->name }}" class="card-img-top" alt="{{ $posts[0]->category->name }}">
        @endif
    
        <div class="card-body text-center">
          <h3 class="card-title"><a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none text-dark">{{ $posts[0]->title }}</a></h3>
          <p>
            <small class="text-muted">
                By. <a href="/posts?author={{ $posts[0]->author->username }}" class="text-decoration-none">{{ $posts[0]->author->name }}</a> in <a href="/posts?category={{ $posts[0]->category->slug }}" class="text-decoration-none">{{ $posts[0]->category->name }}</a> {{ $posts[0]->created_at->diffForHumans() }}
            </small>
          </p>
          <p class="card-text">{{ $posts[0]->excerpt }}</p>

          <a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none btn btn-primary">Read More</a>
        </div>
      </div>
    

    <div class="container">
        <div class="row">
            @foreach($posts->skip(1) as $post)
              <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="position-absolute px-3 py-2 text-white" style="background-color: rgba(0,0,0,0.7)"><a href="/posts?category={{ $post->category->slug }}" class="text-white text-decoration-none">{{ $post->category->name }}</a></div>
                          {{--  pengkondisian jika ada gambar pada database maka tampilkan ini  --}}
                          @if($post->image)
                          {{--  asset storage didapat dari folder public aplikasi kita. tidak usah pakai nama folder post-image karena sudah pada isi database field image dan tidak perlu menaruh folder public kedalam path asset--}}
                              <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}" class="img-fluid"> 
                          {{--  jika tidak ada maka tampilkan ini  --}}
                          @else
                            <img src="https://source.unsplash.com/500x400?{{ $post->category->name }}" class="card-img-top" alt="{{ $post->category->name }}">
                          @endif
                          
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p>
                                <small class="text-muted">
                                    By. <a href="/posts?author={{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> {{ $post->created_at->diffForHumans() }}
                                </small>
                            </p>
                            <p class="card-text">{{ $post->excerpt }}</p>
                            <a href="/posts/{{ $post->slug }}" class="btn btn-primary">Read More</a>
                        </div>
                   </div>
              </div>
            @endforeach
        </div>
    </div>

    {{--  jika tidak ada post maka tampilkan tulisan dibawah  --}}
    @else 
      <p class="text-center fs-4">No Post Find.</p>
    @endif

    {{ $posts->links() }}
  </div>

@endsection