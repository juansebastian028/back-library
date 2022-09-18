<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Rol;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Rol();
        $role->type = 'admin';
        $role->save();

        $role = new Rol();
        $role->type = 'client';
        $role->save();
    }
}
