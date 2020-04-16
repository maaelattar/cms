<?php

use App\Category;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category1 = Category::create(['name' => 'News']);
        $category2 = Category::create(['name' => 'Marketing']);
        $category3 = Category::create(['name' => 'Partnership']);

        $author1 = User::create([
            'name' => 'Mohamed Atar',
            'email' => 'mohamed@atar.com',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);
        $author2 = User::create([
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'role' => 'writer',
            'password' => Hash::make('password'),
        ]);

        $post1 = Post::create([
            'title' => 'We relocated our office to a new designed garage',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit voluptates hic sed totam est cupiditate dolore deleniti! Odit repellendus, beatae iure incidunt laudantium repudiandae quos? Maxime natus quae asperiores sed.',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit voluptates hic sed totam est cupiditate dolore deleniti! Odit repellendus, beatae iure incidunt laudantium repudiandae quos? Maxime natus quae asperiores sed.',
            'category_id' => $category1->id,

            'image' => 'https://maa-cms.s3.eu-central-1.amazonaws.com/images/1.jpg',
            'published_at' => now(),
            'user_id' => $author1->id,
        ]);
        $post2 = $author2->posts()->create([
            'title' => 'Top 5 brilliant content marketing strategies',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit voluptates hic sed totam est cupiditate dolore deleniti! Odit repellendus, beatae iure incidunt laudantium repudiandae quos? Maxime natus quae asperiores sed.',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit voluptates hic sed totam est cupiditate dolore deleniti! Odit repellendus, beatae iure incidunt laudantium repudiandae quos? Maxime natus quae asperiores sed.',
            'category_id' => $category2->id,
            'published_at' => now(),
            'image' => 'https://maa-cms.s3.eu-central-1.amazonaws.com/images/2.jpg',
        ]);
        $post3 = $author1->posts()->create([
            'title' => 'Best practices for minimalist design with example',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit voluptates hic sed totam est cupiditate dolore deleniti! Odit repellendus, beatae iure incidunt laudantium repudiandae quos? Maxime natus quae asperiores sed.',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit voluptates hic sed totam est cupiditate dolore deleniti! Odit repellendus, beatae iure incidunt laudantium repudiandae quos? Maxime natus quae asperiores sed.',
            'category_id' => $category3->id,
            'published_at' => now(),
            'image' => 'https://maa-cms.s3.eu-central-1.amazonaws.com/images/3.jpg',
        ]);
        $post4 = $author2->posts()->create([
            'title' => 'Best practices for minimalist design with example',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit voluptates hic sed totam est cupiditate dolore deleniti! Odit repellendus, beatae iure incidunt laudantium repudiandae quos? Maxime natus quae asperiores sed.',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit voluptates hic sed totam est cupiditate dolore deleniti! Odit repellendus, beatae iure incidunt laudantium repudiandae quos? Maxime natus quae asperiores sed.',
            'category_id' => $category2->id,
            'published_at' => now(),
            'image' => 'https://maa-cms.s3.eu-central-1.amazonaws.com/images/4.jpg',
        ]);
        $tag1 = Tag::create([
            'name' => 'Job',
        ]);
        $tag2 = Tag::create([
            'name' => 'Customers',
        ]);
        $tag3 = Tag::create([
            'name' => 'Record',
        ]);

        $post1->tags()->attach([$tag1->id, $tag2->id]);
        $post2->tags()->attach([$tag2->id, $tag3->id]);
        $post3->tags()->attach([$tag1->id, $tag3->id]);
    }
}