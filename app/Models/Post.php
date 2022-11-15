<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory, Sluggable;

    // ini boleh diisi sisanya gaboleh
    // protected $fillable = ['title', 'excerpt', 'body'];

    // id tidak boleh diisi sisanya boleh
    protected $guarded = ['id'];
    protected $with = ['author', 'category'];


    public function scopeFilter($query, $filters = []){
        // cara pertama
        // if(isset($filters['search']) ? $filters['search'] : false){
        // return $query->where('title', 'like' , '%' . $filters['search'] . '%')
        //           ->orWhere('body', 'like', '%' . $filters['search'] . '%');
        // }

        // cara kedua = query scope
                            // null coalescing operator yaitu tidak memakai isset
        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('title', 'like' , '%' . $search . '%')
                         ->orWhere('body', 'like', '%' . $search . '%');
        });

        $query->when($filters['category'] ?? false, function($query, $category){ //versi callback
            // melakukan join table category, mencari postingan yang sesuai dengan kriteria yg dicari tpi dia juga merupakan dari bagian category
            // querynya punya relationship category kita akan melakukan .. dengan callback
            return $query->whereHas('category', function($query) use ($category){
                $query->where('slug', $category);
            });
        });

        $query->when($filters['author'] ?? false, fn($query, $author)=> //erofunction versi 
            $query->whereHas('author', fn($query) =>$query->where('username', $author))
    );
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
