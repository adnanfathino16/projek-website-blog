<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       

        User::create([
            'name' => 'Adnan Fathino',
            'username' => 'adnanfathino',
            'email' => 'fathinoadnan@gmail.com',
            'password' => bcrypt('160301')
        ]);

        // User::create([
        //     'name' => 'Selfia Nuraga',
        //     'email' => 'nuragaselfia@gmail.com',
        //     'password' => bcrypt('160502')
        // ]);

        User::factory(3)->create();

        Category::create([
            'name' => 'Web Programming',
            'slug' => 'web-programming'
        ]);

        Category::create([
            'name' => 'Web Desain',
            'slug' => 'web-desain'
        ]);

        Category::create([
            'name' => 'Personal',
            'slug' => 'personal'
        ]);

        Post::factory(20)->create();

        // Post::create([
        //     'title' => 'Judul Pertama',
        //     'slug' => 'judul-pertama',
        //     'excerpt' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Necessitatibus impedit quia excepturi, omnis quaerat facere. Illo adipisci, ex minus cumque illum sed doloribus enim quaerat',
        //     'body' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Necessitatibus impedit quia excepturi, omnis quaerat facere. Illo adipisci, ex minus cumque illum sed doloribus enim quaerat. Sequi est molestias sit, repellendus beatae aliquid blanditiis vero laborum numquam, consequatur veniam velit eveniet debitis tenetur ad dolore magnam unde perferendis eaque saepe, eum aspernatur. Deleniti accusantium fugiat nostrum officiis eaque obcaecati inventore, odio a hic reiciendis molestiae? Sapiente nisi harum distinctio dolor molestiae repellat impedit doloremque placeat laboriosam velit iusto animi, eos earum quidem! At debitis quisquam, optio deleniti saepe unde facilis necessitatibus eligendi, quos ratione laudantium corporis alias. Id cumque praesentium sed?',
        //     'category_id' => 1,
        //     'user_id' => 1
        // ]);
        // Post::create([
        //     'title' => 'Judul Ke Dua',
        //     'slug' => 'judul-kedua',
        //     'excerpt' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Necessitatibus impedit quia excepturi, omnis quaerat facere. Illo adipisci, ex minus cumque illum sed doloribus enim quaerat',
        //     'body' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Necessitatibus impedit quia excepturi, omnis quaerat facere. Illo adipisci, ex minus cumque illum sed doloribus enim quaerat. Sequi est molestias sit, repellendus beatae aliquid blanditiis vero laborum numquam, consequatur veniam velit eveniet debitis tenetur ad dolore magnam unde perferendis eaque saepe, eum aspernatur. Deleniti accusantium fugiat nostrum officiis eaque obcaecati inventore, odio a hic reiciendis molestiae? Sapiente nisi harum distinctio dolor molestiae repellat impedit doloremque placeat laboriosam velit iusto animi, eos earum quidem! At debitis quisquam, optio deleniti saepe unde facilis necessitatibus eligendi, quos ratione laudantium corporis alias. Id cumque praesentium sed?',
        //     'category_id' => 1,
        //     'user_id' => 1
        // ]);
        // Post::create([
        //     'title' => 'Judul Ke Tiga',
        //     'slug' => 'judul-ketiga',
        //     'excerpt' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Necessitatibus impedit quia excepturi, omnis quaerat facere. Illo adipisci, ex minus cumque illum sed doloribus enim quaerat',
        //     'body' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Necessitatibus impedit quia excepturi, omnis quaerat facere. Illo adipisci, ex minus cumque illum sed doloribus enim quaerat. Sequi est molestias sit, repellendus beatae aliquid blanditiis vero laborum numquam, consequatur veniam velit eveniet debitis tenetur ad dolore magnam unde perferendis eaque saepe, eum aspernatur. Deleniti accusantium fugiat nostrum officiis eaque obcaecati inventore, odio a hic reiciendis molestiae? Sapiente nisi harum distinctio dolor molestiae repellat impedit doloremque placeat laboriosam velit iusto animi, eos earum quidem! At debitis quisquam, optio deleniti saepe unde facilis necessitatibus eligendi, quos ratione laudantium corporis alias. Id cumque praesentium sed?',
        //     'category_id' => 2,
        //     'user_id' => 1
        // ]);
        // Post::create([
        //     'title' => 'Judul Ke Empat',
        //     'slug' => 'judul-keempat',
        //     'excerpt' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Necessitatibus impedit quia excepturi, omnis quaerat facere. Illo adipisci, ex minus cumque illum sed doloribus enim quaerat',
        //     'body' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Necessitatibus impedit quia excepturi, omnis quaerat facere. Illo adipisci, ex minus cumque illum sed doloribus enim quaerat. Sequi est molestias sit, repellendus beatae aliquid blanditiis vero laborum numquam, consequatur veniam velit eveniet debitis tenetur ad dolore magnam unde perferendis eaque saepe, eum aspernatur. Deleniti accusantium fugiat nostrum officiis eaque obcaecati inventore, odio a hic reiciendis molestiae? Sapiente nisi harum distinctio dolor molestiae repellat impedit doloremque placeat laboriosam velit iusto animi, eos earum quidem! At debitis quisquam, optio deleniti saepe unde facilis necessitatibus eligendi, quos ratione laudantium corporis alias. Id cumque praesentium sed?',
        //     'category_id' => 2,
        //     'user_id' => 2
        // ]);


    }
}
