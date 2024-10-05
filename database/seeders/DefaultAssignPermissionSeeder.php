<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultAssignPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = Role::whereIn('name', ['patient', 'doctor'])->get();
        $permissions = Permission::whereIn('name', ['manage_appointments','manage_patient_visits','manage_transactions'])->get();
        foreach ($permissions as $permission) {
            foreach ($roles as $role) {
                $role->givePermissionTo($permission->id);
            }
        }
    }
}
