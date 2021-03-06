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

        User::factory(6)->create(['role_id' => 3]); // managers
        User::factory(5)->create(['role_id' => 2]); // clients

        Salon::factory(1)->create(['activity_id' => 1, 'user_id' => 2]);
        Salon::factory(1)->create(['activity_id' => 2, 'user_id' => 3]);
        Salon::factory(1)->create(['activity_id' => 3, 'user_id' => 4]);
        Salon::factory(1)->create(['activity_id' => 4, 'user_id' => 5]);
        Salon::factory(1)->create(['activity_id' => 5, 'user_id' => 6]);
        Salon::factory(1)->create(['activity_id' => 6, 'user_id' => 7]);

        Timetable::factory()->create(['salon_id' => 1]);
        Timetable::factory()->create(['salon_id' => 2]);
        Timetable::factory()->create(['salon_id' => 3]);
        Timetable::factory()->create(['salon_id' => 4]);
        Timetable::factory()->create(['salon_id' => 5]);
        Timetable::factory()->create(['salon_id' => 6]);

        Salon::where('id', 1)->update(['timetable_id' => 1]);
        Salon::where('id', 2)->update(['timetable_id' => 2]);
        Salon::where('id', 3)->update(['timetable_id' => 3]);
        Salon::where('id', 4)->update(['timetable_id' => 4]);
        Salon::where('id', 5)->update(['timetable_id' => 5]);
        Salon::where('id', 6)->update(['timetable_id' => 6]);

        Category::create(['name' => 'Peluquería', 'route_name' => 'peluqueria']);
        Category::create(['name' => 'Uñas', 'route_name' => 'unas']);
        Category::create(['name' => 'Faciales', 'route_name' => 'faciales']);
        Category::create(['name' => 'Depilación', 'route_name' => 'depilacion']);
        Category::create(['name' => 'Corporales', 'route_name' => 'corporales']);
        Category::create(['name' => 'Masaje', 'route_name' => 'masaje']);

        Service::factory(20)->create();
    }
}
