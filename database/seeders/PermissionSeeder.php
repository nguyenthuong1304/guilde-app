<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->truncate();

        $permissions = [
            'View',
            'Create',
            'Update',
            'Delete',
            'Access Console',
            'Manager Users',
        ];

        $data = [];

        foreach ($permissions as $permission) {
            $data[] = ['name' => $permission];
        }

        Permission::insert($data);
    }
}
