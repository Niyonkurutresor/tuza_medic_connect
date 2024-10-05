<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DefaultPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'name' => 'manage_doctors',
                'display_name' => 'Manage Doctors',
            ],
            [
                'name' => 'manage_patients',
                'display_name' => 'Manage Patients',
            ],
            [
                'name' => 'manage_appointments',
                'display_name' => 'Manage Appointments',
            ],
            [
                'name' => 'manage_patient_visits',
                'display_name' => 'Manage Patient Visits',
            ],
            [
                'name' => 'manage_staff',
                'display_name' => 'Manage Staff',
            ],
            [
                'name' => 'manage_doctor_sessions',
                'display_name' => 'Manage Doctor Sessions',
            ],
            [
                'name' => 'manage_settings',
                'display_name' => 'Manage Settings',
            ],
            [
                'name' => 'manage_services',
                'display_name' => 'Manage Services',
            ],
            [
                'name' => 'manage_specialities',
                'display_name' => 'Manage Specialities',
            ],
            [
                'name' => 'manage_countries',
                'display_name' => 'Manage Countries',
            ],
            [
                'name' => 'manage_states',
                'display_name' => 'Manage States',
            ],
            [
                'name' => 'manage_cities',
                'display_name' => 'Manage Cities',
            ],
            [
                'name' => 'manage_roles',
                'display_name' => 'Manage Roles',
            ],
            [
                'name' => 'manage_currencies',
                'display_name' => 'Manage Currencies',
            ],
            [
                'name' => 'manage_admin_dashboard',
                'display_name' => 'Manage Admin Dashboard',
            ],
            [
                'name' => 'manage_front_cms',
                'display_name' => 'Manage Front CMS',
            ],
            [
                'name' => 'manage_transactions',
                'display_name' => 'Manage Transactions',
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
