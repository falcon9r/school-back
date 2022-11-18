<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Teacher::truncate();
        $super_admin = Teacher::create([
            'login' => 'Admin',
            'password' => bcrypt('password')
        ]);
        $super_admin->assignRole(Role::findById(1)->id);
        Teacher::factory()->count(20)->create();
    }
}
