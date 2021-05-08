<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Category;
use App\Models\Role;
use App\Models\Salon;
use App\Models\Service;
use App\Models\Timetable;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('es_ES');

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'client']);
        Role::create(['name' => 'manager']);

        // 1 Admin
        DB::table('users')->insert([
            'name' => 'Rasma',
            'surname' => 'Butkute',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'phone' => $faker->mobileNumber,
            'postal_code' => $faker->postcode,
            'password' => bcrypt('12345678'),
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'role_id' => 1
        ]);

        // 6 activities
        Activity::create(['name' => 'Peluquería']);
        Activity::create(['name' => 'Barbería']);
        Activity::create(['name' => 'Centro de Depilación']);
        Activity::create(['name' => 'Centro de Estética']);
        Activity::create(['name' => 'Centro de Manicura']);
        Activity::create(['name' => 'Masajes']);

        User::factory(5)->create(['role_id' => 2]); // clients
        User::factory(5)->create(['role_id' => 3]); // managers

        Timetable::factory()->create();

        Salon::factory(2)->create(['activity_id' => 1]);
        Salon::factory(2)->create(['activity_id' => 2]);
        Salon::factory(2)->create(['activity_id' => 3]);
        Salon::factory(2)->create(['activity_id' => 4]);
        Salon::factory(2)->create(['activity_id' => 5]);
        Salon::factory(2)->create(['activity_id' => 6]);

        Category::create(['name' => 'Peluquería']);
        Category::create(['name' => 'Faciales']);
        Category::create(['name' => 'Uñas']);
        Category::create(['name' => 'Depilación']);
        Category::create(['name' => 'Corporales']);
        Category::create(['name' => 'Masaje']);

        Service::factory(10)->create();


    }
}
