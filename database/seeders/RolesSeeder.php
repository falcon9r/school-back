<?php

namespace Database\Seeders;

use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'super-admin',
            ],
            [
                'name' => 'admin'
            ]
        ];
        foreach ($roles as $role) {
            try{
                Role::create($role);
            }catch(Exception $ex){

            }
        }
    }
}
