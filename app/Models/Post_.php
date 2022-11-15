<?php

namespace App\Models;


class Post {
    private static $blog_posts = [
        [
            "title" => "Judul Post Pertama",
            "slug" => "judul-post-pertama",
            "author" => "Selfia Nuraga",
            "body" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iusto numquam esse et quo, provident quos delectus quibusdam ad deleniti, dignissimos vero harum, explicabo corrupti doloribus minima mollitia eligendi. Facilis minima beatae saepe et in fuga aperiam, similique repudiandae, autem architecto quibusdam ipsum nobis sint hic earum officia! Odio facere quos accusantium assumenda accusamus, maxime sit vel eveniet architecto porro! Harum repellendus optio aut quas, iusto officia fuga laboriosam perspiciatis odit eaque, quaerat laudantium quibusdam praesentium et cumque quod numquam itaque."
        ],
        [
            "title" => "Judul Post Kedua",
            "slug" => "judul-post-kedua",
            "author" => "Adnan Fathino",
            "body" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iusto numquam esse et quo, provident quos delectus quibusdam ad deleniti, dignissimos vero harum, explicabo corrupti doloribus minima mollitia eligendi. Facilis minima beatae saepe et in fuga aperiam, similique repudiandae, autem architecto quibusdam ipsum nobis sint hic earum officia! Odio facere quos accusantium assumenda accusamus, maxime sit vel eveniet architecto porro! Harum repellendus optio aut quas, iusto officia fuga laboriosam perspiciatis odit eaque, quaerat laudantium quibusdam praesentium et cumque quod numquam itaque."
        ]
    ];

    public static function all(){
        return collect(self::$blog_posts);
    }

    public static function find($slug){
        // self untuk property static 
        // static untuk method static
        $posts = static::all();
        // ambil semua posts yang bentuknya collections lalu cari yang pertama ditemukan dimana slugnya sama dengan $slug
        return $posts->firstWhere('slug', $slug);
    }
}
