<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Country;
use App\Models\Reader;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        //categories = Category::factory(10)->create();ű

        $category_names = ['Programming', 'Science', 'History', 'Math'];
        foreach ($category_names as $category_name) {
            $category = Category::factory()->create([
                'name' => $category_name,
            ]);
        }

        // $categories = Category::factory()->create([
        //     'name' => 'Programming',
        //     'name' => 'Science',
        //     'name' => 'History',
        // ]);
        $books = Book::factory(100)->create();

        Country::factory(13)->create();

        $authors = Author::factory(20)->create();

        foreach ($books as $book) {
            //$book->authors()->attach($authors->random());
            $book->authors()->attach($authors->random(rand(1, 3)));
        }

        $readers = Reader::factory(100)->create();

        foreach ($readers as $reader) {
            $reader->books()->attach($books->random(rand(1, 5)),[
                'start_date' => now(),
                'end_date' => now()->addDays(rand(10,30)),
                'is_returned' => fake()->boolean(),
            ]);
        }
    }
}
