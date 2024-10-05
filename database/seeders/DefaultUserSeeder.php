<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Specialization;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'contact' => '1234567890',
                'gender' => User::MALE,
                'type' => User::ADMIN,
                'email' => 'admin@infycare.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('123456'),
                'region_code' => '91',
            ],
            [
                'first_name' => 'Adam',
                'last_name' => 'Diaz',
                'contact' => '1234567890',
                'gender' => User::MALE,
                'type' => User::DOCTOR,
                'email' => 'doctor@infycare.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('123456'),
            ],
            [
                'first_name' => 'Aiko',
                'last_name' => 'Walsh',
                'contact' => '1234567890',
                'gender' => User::MALE,
                'type' => User::PATIENT,
                'email' => 'patient@infycare.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('123456'),
            ],
        ];

        foreach ($users as $key => $user) {
            $user = User::create($user);
            if ($key == 1) {
                $doctor = Doctor::create(['user_id' => $user->id]);
                $user->address()->create(['owner_id' => $user->id]);
            }
            if ($key == 2) {
                $patient = Patient::create(['user_id' => $user->id, 'patient_unique_id' => 'UNIQUE12']);
                $patient->address()->create(['owner_id' => $patient['user_id']]);
            }
        }

        $specializationIds = Specialization::pluck('id');
        $doctor->specializations()->sync($specializationIds);
    }
}
