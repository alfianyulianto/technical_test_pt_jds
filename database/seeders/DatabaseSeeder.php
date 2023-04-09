<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Comment;
use App\Models\News;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    // \App\Models\User::factory(10)->create();

    // \App\Models\User::factory()->create([
    //     'name' => 'Test User',
    //     'email' => 'test@example.com',
    // ]);

    User::create([
      'name' => 'Admin',
      'email' => 'admin@gmail.com',
      'password' => Hash::make('password'),
      'is_admin' => true
    ]);
    User::create([
      'name' => 'Alfian',
      'email' => 'alfian@gmail.com',
      'password' => Hash::make('123456'),
      'is_admin' => false
    ]);
    User::create([
      'name' => 'Budi',
      'email' => 'budi@gmail.com',
      'password' => Hash::make('123456'),
      'is_admin' => false
    ]);

    // News::create([
    //   'user_id' => 1,
    //   'title' => 'News Number One',
    //   'slug' => 'news-number-one',
    //   'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam vitae odio commodi, excepturi veniam perferendis in iure sed. Soluta modi eligendi iure ratione voluptate sed, culpa commodi quos dolores nemo ipsa consequatur quasi quas placeat ut, facere, doloremque voluptatem quia blanditiis labore corporis! Ducimus assumenda, doloribus molestiae temporibus saepe laborum sunt voluptatem consectetur aliquam nam laboriosam libero natus aperiam accusantium eius itaque tenetur cumque perferendis optio similique voluptates eaque, neque quod? Adipisci repellat ipsum, reiciendis facere porro ex sequi aperiam corporis quam beatae temporibus ipsam magni maxime vitae! Eaque, consequatur! Saepe modi, dolor error quasi harum repudiandae? Nesciunt, enim vel!',
    //   'images' => 'news_one.jpg'
    // ]);
    // News::create([
    //   'user_id' => 1,
    //   'title' => 'News Number Two',
    //   'slug' => 'news-number-two',
    //   'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam vitae odio commodi, excepturi veniam perferendis in iure sed. Soluta modi eligendi iure ratione voluptate sed, culpa commodi quos dolores nemo ipsa consequatur quasi quas placeat ut, facere, doloremque voluptatem quia blanditiis labore corporis! ',
    //   'images' => 'news_two.jpg'
    // ]);
    // News::create([
    //   'user_id' => 1,
    //   'title' => 'News Number Three',
    //   'slug' => 'news-number-three',
    //   'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam vitae odio commodi, excepturi veniam perferendis in iure sed. Soluta modi eligendi iure ratione voluptate sed, culpa commodi quos dolores nemo ipsa consequatur quasi quas placeat ut, facere, doloremque voluptatem quia blanditiis labore corporis! Ducimus assumenda, doloribus molestiae temporibus saepe laborum sunt voluptatem consectetur aliquam nam laboriosam libero natus aperiam accusantium eius itaque tenetur cumque perferendis optio similique voluptates eaque, neque quod? Adipisci repellat ipsum, reiciendis facere porro ex sequi aperiam corporis quam beatae temporibus ipsam magni maxime vitae! Eaque, consequatur! Saepe modi, dolor error quasi harum repudiandae? Nesciunt, enim vel!',
    //   'images' => 'news_three.jpg'
    // ]);
    // News::create([
    //   'user_id' => 1,
    //   'title' => 'News Number Four',
    //   'slug' => 'news-number-four',
    //   'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam vitae odio commodi, excepturi veniam perferendis in iure sed. Soluta modi eligendi iure ratione voluptate sed, culpa commodi quos dolores nemo ipsa consequatur quasi quas placeat ut, facere, doloremque voluptatem quia blanditiis labore corporis! Ducimus assumenda, doloribus molestiae temporibus saepe laborum sunt voluptatem consectetur aliquam nam laboriosam libero natus aperiam accusantium eius itaque tenetur cumque perferendis optio similique voluptates eaque, neque quod? Adipisci repellat ipsum, reiciendis facere porro ex sequi aperiam corporis quam beatae temporibus ipsam magni maxime vitae! Eaque, consequatur! Saepe modi, dolor error quasi harum repudiandae? Nesciunt, enim vel!',
    //   'images' => 'news_four.jpg'
    // ]);

    // Comment::create([
    //   'news_id' => 1,
    //   'user_id' => 2,
    //   'comment' => 'Berita ini bagus'
    // ]);
    // Comment::create([
    //   'news_id' => 2,
    //   'user_id' => 2,
    //   'comment' => 'Beritanya kurang menarik perhatian'
    // ]);
  }
}
