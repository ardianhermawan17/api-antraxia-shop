<?php

use App\User;
use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new User;
        $administrator->username = "Administrator";
        $administrator->name = "Site Administrator";
        $administrator->email = "administrator@antraxia.com";
        $administrator->roles = json_encode(["ADMIN"]);
        $administrator->password = \Hash::make("ardian123");
        $administrator->avatar = "saat-ini-tidak-ada-file.png";
        $administrator->address = "Surabaya, Jawa Timur, JL.margorejo 31 A";
        $administrator->phone = "082143581950";

        $administrator->save();

        $this->command->info("User Admin berhasil diinsert");

        // second user

        $staff = new User;
        $staff->username = "Staff";
        $staff->name = "Staff Content";
        $staff->email = "staff@antraxia.com";
        $staff->roles = json_encode(["STAFF"]);
        $staff->password = \Hash::make("staff123");
        $staff->avatar = "saat-ini-tidak-ada-file.png";
        $staff->address = "Surabaya, Jawa Timur, JL.margorejo 31 A";
        $staff->phone = "08214242140";

        $staff->save();

        $this->command->info("User Admin berhasil diinsert");

        //Customer

        $customer = new User;
        $customer->username = "customer";
        $customer->name = "Customer Anjanath";
        $customer->email = "customer@antraxia.com";
        $customer->roles = json_encode(["CUSTOMER"]);
        $customer->password = \Hash::make("customer123");
        $customer->avatar = "saat-ini-tidak-ada-file.png";
        $customer->address = "Surabaya, Jawa Timur, JL.margorejo 31 A";
        $customer->phone = "082143581240";

        $customer->save();

        $this->command->info("User Admin berhasil diinsert");
    }
}
