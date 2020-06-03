<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(AdministratorSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(BooksTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ProvincesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
    }
}
