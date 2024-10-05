<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DefaultStaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $input = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'contact' => '1234567890',
            'gender' => User::MALE,
            'type' => User::STAFF,
            'email' => 'john@gamil.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('123456'),
            'region_code' => '91',
        ];

        $user = User::create($input);

        /** @var Role $staffRole */
        $staffRole = Role::create(['name' => 'staff', 'display_name' => 'Staff']);
        $user->assignRole($staffRole);

        /** @var Permission $allPermission */
        $allPermission = Permission::pluck('id');
        $staffRole->givePermissionTo($allPermission);
    }
}
