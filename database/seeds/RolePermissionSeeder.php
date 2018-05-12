<?php

use App\Models\RolePermission;
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
        $permissions = getOnlyPermission();

        RolePermission::create([
            'role_name' => 'admin',
            'role_description' => 'Admin role permission',
            'role_permission' => serialize($permissions)
        ]);
    }
}
