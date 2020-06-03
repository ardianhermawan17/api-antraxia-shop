<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [];
        $faker = Faker\Factory::create();
        $faker->addProvider(new \Mmo\Faker\PicsumProvider($faker));
        $image_categories = ['abstract', 'animals', 'business', 'cats', 'city', 'food',
            'nature', 'technics', 'transport'];
        for($i=0;$i<1;$i++){
            $name = $faker->unique()->word();
            $name = str_replace('.', '', $name);
            $slug = str_replace(' ', '-', strtolower($name));

//            $avatar_path = url(Storage::url('images/categories'));
            $url = $faker->picsumUrl(200,250,null,true);
            $contents = file_get_contents($url);
            $name_img = substr($url, strrpos($url, '/') + 1);
            $hash = 'images/categories/' . Hash::make($name_img). '.jpg';
            Storage::disk('public')->put($hash, $contents);

            //COVer fail
//            $category = $image_categories[mt_rand(0, 8)];
//
//            $image_fullpath = $faker->image( $image_path, 500, 300, $category, true, true, $category);
            $categories[$i] = [
                'name' => $name,
                'slug' => $slug,
                'image' => $hash,
                'status' => 'PUBLISH',
                'created_at' => Carbon\Carbon::now(),
            ];
        }
        DB::table('categories')->insert($categories);
    }
}
