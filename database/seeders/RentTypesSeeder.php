<?php

namespace Database\Seeders;

use App\Models\RentType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rentTypes = [
            ['name' => 'Home Rental', 'description' => 'Find comfortable homes for rent. Perfect for short-term or long-term stays.'],
            ['name' => 'Office Rental', 'description' => 'Flexible office spaces to meet your business needs. Choose from shared or private offices.'],
            ['name' => 'Car Rental', 'description' => 'Affordable car rental services for daily or long-term use. Wide range of vehicles available.'],
            ['name' => 'Luxury Goods Rental', 'description' => 'Rent high-end luxury items for special occasions. Make every event unforgettable.'],
            ['name' => 'Electronics on Rent', 'description' => 'Get the latest electronics without buying. Flexible plans for personal or business use.'],
            ['name' => 'Furniture on Rent', 'description' => 'Furnish your home or office with stylish rentals. Affordable and hassle-free.'],
            ['name' => 'Yachts on Rent', 'description' => 'Experience luxury on water with yacht rentals. Ideal for parties or private getaways.'],
            ['name' => 'Medical Equipment on Rentals', 'description' => 'Access essential medical devices on rent. Reliable and cost-effective solutions.'],
            ['name' => 'Industrial Equipment', 'description' => 'Heavy-duty tools and equipment for industries. Flexible rental options available.'],
            ['name' => 'Parking Rental', 'description' => 'Secure parking spaces available for rent. Choose convenient locations for your vehicle.'],
            ['name' => 'Service Apartments & Short-Term Rentals', 'description' => 'Comfortable service apartments for short stays. Fully equipped and centrally located.'],
            ['name' => 'Warehouse & Storage Facilities', 'description' => 'Spacious warehouses for all your storage needs. Affordable short and long-term options.'],
            ['name' => 'Business License and Desk Rentals', 'description' => 'Start your business with licensed desk spaces. Fully furnished and ready to use.'],
            ['name' => 'Equipment and Tool Rentals', 'description' => 'Wide range of tools for DIY or professional work. Rent what you need, when you need it.'],
            ['name' => 'Bike and Scooter Rentals', 'description' => 'Eco-friendly bikes and scooters for rent. Ideal for short commutes or leisure rides.'],
            ['name' => 'Pet Services', 'description' => 'Rent pet care products and services. Convenient solutions for pet owners.'],
            ['name' => 'Marina Berths', 'description' => 'Dock your boats securely with marina berths. Flexible rental terms available.'],
            ['name' => 'Education Fees', 'description' => 'Pay education fees in manageable installments. Convenient financial solutions.'],
            ['name' => 'Fashion and Accessories Rentals', 'description' => 'Stay trendy with fashion rentals. Access designer wear and accessories with ease.'],
        ];

        foreach ($rentTypes as $index => $type) {
            RentType::create([
                'name'        => $type['name'],
                'slug'        => Str::slug($type['name']),
                'description' => $type['description'],
                'image'       => null,
                'sort_order'  => $index + 1,
            ]);
        }
    }
}
