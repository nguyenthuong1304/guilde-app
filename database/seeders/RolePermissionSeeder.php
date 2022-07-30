<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::all('id', 'name');
        $roles = Role::all('id', 'name');

        $roles->each(function ($role) use ($permissions) {
            switch ($role->name) {
                case 'Admin':
                    $role->permissions()->sync($permissions->map(fn ($p) => $p->id));
                    break;
                case 'Member':
                    $role->permissions()->sync($permissions->where('name', ['Access Console'])->map(fn ($p) => $p->id));
                    break;
                default:
                    $role->permissions()->sync($permissions->where('name', ['Create', 'Update', 'View', 'Access Console', 'Delete'])->map(fn ($p) => $p->id));
                    break;
            }
        });
    }
}
