<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        Role::create([
//            'id' => 1,
//            'name' => 'admin'
//        ]);
//
//        Role::create([
//            'id' => 2,
//            'name' => 'client'
//        ]);

//        User::create([
//            'role_id' => 1,
//            'username' => 'admin',
//            'name' => 'admin',
//            'email' => "admin@admin.com",
//            'password' => Hash::make('12345678'),
//            'email_verified_at' => now(),
//        ]);
//
//        User::create([
//            'role_id' => 2,
//            'username' => 'kejvin',
//            'name' => 'Kejvin',
//            'email' => "kejvin.braka@atis.al",
//            'password' => Hash::make('12345678'),
//            'email_verified_at' => now(),
//        ]);


        User::factory(100)->create()->each(function ($user) {
            Post::factory(3)->create(
                ['user_id' => $user->id,
                    'title' => implode(' ', [fake()->realText(50)]),
                    'body' => implode(" ", [fake()->realText(500)]),
                ]
            )->each(function ($post) {
                Comment::factory(3)->create(
                    [
                        'user_id' => $post->user_id,
                        'post_id' => $post->id,
                        'body' => implode(" ", [fake()->realText(30)]),
                    ]
                );
            });
        });

    }
}
