<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // MANUAL

//        DB::table('users')->insert([
//            'name' => 'Ardian',
//            'email' => 'ardian@gmail.com',
//            'password' => bcrypt('ardian123'),
//            'roles' => json_encode(['CUSTOMER']),
//            'status' => 'ACTIVE',
//        ],
//        [
//            'name' => 'Yoshi',
//            'email' => 'lordyoshi@gmail.com',
//            'password' => bcrypt('123456'),
//            'roles' => json_encode(['CUSTOMER']),
//            'status' => 'ACTIVE'
//        ]);

        $users = [];
        $faker = Faker\Factory::create();
        $faker->addProvider(new \Mmo\Faker\PicsumProvider($faker));
        for($i=0;$i<1;$i++){
            $url = $faker->picsumUrl(200,250,null,true);
            //size

            $contents = file_get_contents($url);
            $name = substr($url, strrpos($url, '/') + 1);
            $hash = Hash::make($name);
            Storage::disk('public')->put('images/users/' . $hash . '.jpg', $contents);


            $users[$i] = [
                'name'       => $faker->name,
                'email'      => $faker->unique()->safeEmail,
                'password'   => bcrypt('123456'),
                'roles'      => json_encode(['CUSTOMER']),
                'avatar'     => $hash . '.jpg',
                'status'     => 'ACTIVE',
                'created_at' => Carbon\Carbon::now(),
            ];
        }
        DB::table('users')->insert($users);
    }
}
