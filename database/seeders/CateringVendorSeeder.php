<?php

namespace Database\Seeders;

use App\Models\CateringMenu;
use App\Models\CateringVendor;
use Illuminate\Database\Seeder;

class CateringVendorSeeder extends Seeder
{
    public function run()
    {
        $vendors = [
            [
                'name' => 'Catering Sehat',
                'description' => 'Menyediakan menu sehat dengan bahan-bahan organik',
                'contact' => '081234567890',
                'address' => 'Jl. Sehat No. 123, Jakarta',
                'is_active' => true,
                'menus' => [
                    [
                        'name' => 'Paket Sehat Standard',
                        'description' => 'Nasi merah, ayam panggang, sayur kukus, buah segar',
                        'price_per_pax' => 35000,
                        'minimum_order' => 20,
                        'delivery_time_estimate' => 60,
                        'is_available' => true,
                    ],
                    [
                        'name' => 'Paket Sehat Premium',
                        'description' => 'Nasi merah, salmon panggang, sayur kukus, buah segar, jus detox',
                        'price_per_pax' => 55000,
                        'minimum_order' => 15,
                        'delivery_time_estimate' => 90,
                        'is_available' => true,
                    ],
                ],
            ],
            [
                'name' => 'Catering Nikmat',
                'description' => 'Menyediakan menu tradisional dengan cita rasa nikmat',
                'contact' => '082345678901',
                'address' => 'Jl. Nikmat No. 456, Jakarta',
                'is_active' => true,
                'menus' => [
                    [
                        'name' => 'Paket Nikmat Standard',
                        'description' => 'Nasi putih, ayam goreng, sayur asem, tempe orek, kerupuk',
                        'price_per_pax' => 30000,
                        'minimum_order' => 25,
                        'delivery_time_estimate' => 45,
                        'is_available' => true,
                    ],
                    [
                        'name' => 'Paket Nikmat Spesial',
                        'description' => 'Nasi uduk, ayam bakar, lalapan, sambal, emping, es teh',
                        'price_per_pax' => 40000,
                        'minimum_order' => 20,
                        'delivery_time_estimate' => 60,
                        'is_available' => true,
                    ],
                ],
            ],
        ];

        foreach ($vendors as $vendorData) {
            $menus = $vendorData['menus'];
            unset($vendorData['menus']);

            $vendor = CateringVendor::create($vendorData);

            foreach ($menus as $menu) {
                $vendor->menus()->create($menu);
            }
        }
    }
}