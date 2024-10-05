<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Database\Seeder;

class DefaultServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $input = [
            [
                'category_id' => '1',
                'name' => 'Diagnostics',
                'charges' => '500',
                'status' => Service::ACTIVE,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
                'icon' => asset('assets/front/images/services_images/Diagnostics.png'),
            ],
            [
                'category_id' => '2',
                'name' => 'Treatment',
                'charges' => '500',
                'status' => Service::ACTIVE,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
                'icon' => asset('assets/front/images/services_images/Treatment.png'),
            ],
            [
                'category_id' => '1',
                'name' => 'Surgery',
                'charges' => '500',
                'status' => Service::ACTIVE,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
                'icon' => asset('assets/front/images/services_images/Surgery.png'),
            ],
            [
                'category_id' => '4',
                'name' => 'Emergency',
                'charges' => '500',
                'status' => Service::ACTIVE,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
                'icon' => asset('assets/front/images/services_images/Emergency.png'),
            ],
            [
                'category_id' => '4',
                'name' => 'Vaccine',
                'charges' => '500',
                'status' => Service::ACTIVE,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
                'icon' => asset('assets/front/images/services_images/Vaccine.png'),
            ],
            [
                'category_id' => '1',
                'name' => 'Qualified Doctors',
                'charges' => '500',
                'status' => Service::ACTIVE,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
                'icon' => asset('assets/front/images/services_images/qualified_doctors.png'),
            ],
        ];

        $doctor = Doctor::firstOrfail();

        foreach ($input as $data) {
            $image = $data['icon'];
            unset($data['icon']);
            $service = Service::create($data);
            $service->serviceDoctors()->sync($doctor->id);
        }
    }
}
