<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->truncate();
        DB::table('role_permission')->truncate();

        $roles = ['Admin', 'Writer', 'Viewer', 'Member'];
        $data = [];

        foreach ($roles as $role) {
            $data[] = ['name' => $role];
        }

        Role::insert($data);
    }
}
