<?php

use Illuminate\Database\Seeder;
use App\CommonModels\Role;


class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
        	'name' => 'SuperAdmin'
        ]);
        Role::create([
        	'name' => 'School'
        ]);
        Role::create([
        	'name' => 'Teacher'
        ]);
        Role::create([
        	'name' => 'Student'
        ]);
    }
}
