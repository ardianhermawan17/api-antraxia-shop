<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Manual

//        DB::table('books')->insert([
//            'title' => 'C++ High Performance',
//            'slug' => 'c++-high-performance',
//            'description' => 'Write code that scales across CPU registers, multi-core, and machine clusters',
//            'author' => 'Viktor Sehr, Björn Andrist',
//            'publisher' => 'Packtpub',
//            'cover' => 'c++-high-performance.png',
//            'price' => 100000,
//            'weight' => 0.5,
//            'status' => 'PUBLISH',
//        ],[
//            'title' => 'Mastering Linux Security and Hardening',
//            'slug' => 'mastering-linux-security-and-hardening',
//            'description' => 'A comprehensive guide to mastering the art of preventing your Linux system from getting compromised',
//            'author' => 'Donald A. Tevault',
//            'publisher' => 'Packtpub',
//            'cover' => 'mastering-linux-security-and-hardening.png',
//            'price' => 125000,
//            'weight' => 0.5,
//            'status' => 'PUBLISH',
//        ],[
//            'title' => 'Mastering PostgreSQL 10',
//            'slug' => 'mastering-postgresql-10',
//            'description' => 'Master the capabilities of PostgreSQL 10 to efficiently manage and maintain your database',
//            'author' => 'Hans-Jürgen Schönig',
//            'publisher' => 'Packtpub',
//            'cover' => 'mastering-postgresql-10.png',
//            'price' => 90000,
//            'weight' => 0.5,
//            'status' => 'PUBLISH',
//        ],[
//            'title' => 'Python Programming Blueprints',
//            'slug' => 'c++-high-performance',
//            'description' => 'How to build useful, real-world applications in the Python programming language',
//            'author' => 'Daniel Furtado, Marcus Pennington',
//            'publisher' => 'Packtpub',
//            'cover' => 'python-programming-blueprints.png',
//            'price' => 75000,
//            'weight' => 0.5,
//            'status' => 'PUBLISH',
//        ]);
        $books = [];
        $faker = Faker\Factory::create();
        $faker->addProvider(new \Mmo\Faker\PicsumProvider($faker));
        $image_categories = ['abstract', 'animals', 'business', 'cats', 'city', 'food',
            'nature', 'technics', 'transport'];
        for($i=0;$i<1;$i++){
            $title = $faker->sentence(mt_rand(3, 6));
            $title = str_replace('.', '', $title);
            $slug = str_replace(' ', '-', strtolower($title));


//            $cover_path = url(Storage::url('images/books'));
            $url = $faker->picsumUrl(200,250,null,true);
            $contents = file_get_contents($url);
            $name = substr($url, strrpos($url, '/') + 1);
            $hash = 'images/books/' . Hash::make($name). '.jpg';
            Storage::disk('public')->put($hash, $contents);

//            cover fail
//            $category = $image_categories[mt_rand(0, 8)];
//            $cover_fullpath = $faker->image( $cover_path, 300, 500, $category, true, true, $category);

            $books[$i] = [
                'title' => $title,
                'slug' => $slug,
                'description' => $faker->text(255),
                'author' => $faker->name,
                'publisher' => $faker->company,
                'cover' => $hash,
                'stock' => mt_rand(1,20),
                'price' => mt_rand(1, 10) * 50000,
                'weight' => 0.5,
                'status' => 'PUBLISH',
                'created_at' => Carbon\Carbon::now(),
            ];
        }
        DB::table('books')->insert($books);
    }
}
