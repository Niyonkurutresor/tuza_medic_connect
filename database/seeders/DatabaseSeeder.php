<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $this->call(DefaultSpecializationSeeder::class);
        $this->call(DefaultUserSeeder::class);
        $this->call(SettingTableSeeder::class);
        $this->call(CreateCountriesSeeder::class);
        $this->call(DefaultPermissionSeeder::class);
        $this->call(DefaultRoleSeeder::class);
        $this->call(DefaultServiceCategorySeeder::class);
        $this->call(DefaultServicesSeeder::class);
        $this->call(DefaultCurrenciesSeeder::class);
        $this->call(DefaultStaffSeeder::class);
        $this->call(DefaultSliderSeeder::class);
        $this->call(DefaultFaqsSeeder::class);
        $this->call(DefaultFrontPatientTestimonialsSeeder::class);
        $this->call(AddFieldsSettingTableSeeder::class);
        $this->call(AddTwoFieldsSettingSeeder::class);
        $this->call(AddEmailVerifiedFieldSettingTableSeeder::class);
        $this->call(AddAboutUsImageFieldsSettingSeeder::class);
        $this->call(AddAboutExperienceFieldInSettingSeeder::class);
        $this->call(DefaultPaymentGatewaySeeder::class);
        $this->call(DefaultMedicinePermissionSeeder::class);
        $this->call(DefaultAssignPermissionSeeder::class);
        $this->call(SmartPatientCardsSeeder::class);
        
    }
}
