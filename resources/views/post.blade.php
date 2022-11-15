@extends('layouts.main')

@section('container')

<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <h1 class="mb-3">{{ $post->title }}</h1>

            <p>By. <a href="/posts?author={{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> in <a href="/posts?category={{ $post->category->slug }}" class="text-decoration-none">{{ $post->category->name }}</a></p>

            {{--  pengkondisian jika ada gambar pada database maka tampilkan ini  --}}
            @if($post->image)
            {{--  asset storage didapat dari folder public aplikasi kita. tidak usah pakai nama folder post-image karena sudah pada isi database field image dan tidak perlu menaruh folder public kedalam path asset--}}
            <div style="max-height: 350px; overflow:hidden">
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}" class="img-fluid">
            </div>  
            {{--  jika tidak ada maka tampilkan ini  --}}
            @else
            <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" alt="{{ $post->category->name }}" class="img-fluid">
            @endif
            

            <article class="my-3 fs-5">
                {!! $post->body !!}
            </article>

            <a href="/posts" class="d-block mt-3">Kembali ke posts</a>
        </div>
    </div>
</div>


@endsection