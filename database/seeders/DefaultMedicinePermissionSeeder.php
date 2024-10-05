<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DefaultMedicinePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles1 = Role::all();
        $roles2 = Role::whereIn('name', ['clinic_admin', 'doctor', 'staff'])->get();
        $medicinePermission = Permission::whereName('manage_medicines')->first();
        $permissionExist = Permission::whereName('manage_medicines')->exists();

        if (! $permissionExist) {
            $permission = Permission::create(
                [
                    'name' => 'manage_medicines',
                    'display_name' => 'Manage Medicines',
                ],
            );
            foreach ($roles2 as $role) {
                $role->givePermissionTo($permission);
            }
        } else {
            foreach ($roles1 as $role) {
                $role->revokePermissionTo($medicinePermission->id);
            }
            foreach ($roles2 as $role) {
                $role->givePermissionTo($medicinePermission->id);
            }
        }

    }
}
