<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DefaultHolidayPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'clinic_admin',
                'display_name' => 'Clinic Admin',
                'is_default' => true,
            ],
            [
                'name' => 'doctor',
                'display_name' => 'Doctor',
                'is_default' => true,
            ],
        ];

        foreach ($roles as $role) {
            $roleExist = Role::whereName($role)->exists();
            if (! $roleExist) {
                Role::create($role);
            }
        }

        $permission = [
            'name' => 'manage_doctors_holiday',
            'display_name' => 'Manage Doctors Holiday',
            'guard_name' => 'web',
        ];

        $holidayPermissionExist = Permission::where('name', 'manage_doctors_holiday')->exists();

        if (! $holidayPermissionExist) {
            $holidayPermission = Permission::create($permission);

            $adminRoles = User::role('clinic_admin')->get();
            foreach ($adminRoles as $adminRole) {
                if (! $adminRole->hasPermissionTo('manage_doctors_holiday')) {
                    $adminRole->givePermissionTo($holidayPermission);
                }
            }

            $doctorRoles = User::role('doctor')->get();
            foreach ($doctorRoles as $doctorRole) {
                if (! $doctorRole->hasPermissionTo('manage_doctors_holiday')) {
                    $doctorRole->givePermissionTo($holidayPermission);
                }
            }
        }
    }
}
