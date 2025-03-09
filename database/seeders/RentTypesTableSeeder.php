<?php
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RentTypesTableSeeder extends Seeder
{
    public function run()
    {
        $rentTypes = [
            [
                'name'        => 'Home Rental',
                'description' => 'Find rental homes suited to your needs. Perfect for short or long-term stays.',
                'status'      => 1,
                'sort_order'  => 1,
            ],
            [
                'name'        => 'Office Rental',
                'description' => 'Discover fully equipped office spaces for rent. Ideal for businesses of all sizes.',
                'status'      => 1,
                'sort_order'  => 2,
            ],
            [
                'name'        => 'Car Rental',
                'description' => 'Rent cars for daily commutes or special trips. Affordable and reliable options.',
                'status'      => 1,
                'sort_order'  => 3,
            ],
            [
                'name'        => 'Luxury Goods Rental',
                'description' => 'Access premium luxury items without ownership. Perfect for special occasions.',
                'status'      => 1,
                'sort_order'  => 4,
            ],
            [
                'name'        => 'Electronics on Rent',
                'description' => 'Get the latest electronics on rent. Ideal for temporary or project-based needs.',
                'status'      => 1,
                'sort_order'  => 5,
            ],
            [
                'name'        => 'Furniture on Rent',
                'description' => 'Stylish furniture rentals to furnish your space effortlessly. Flexible terms available.',
                'status'      => 1,
                'sort_order'  => 6,
            ],
            [
                'name'        => 'Yachts on Rent',
                'description' => 'Rent luxurious yachts for leisure or events. Tailored for a premium experience.',
                'status'      => 1,
                'sort_order'  => 7,
            ],
            [
                'name'        => 'Medical Equipment on Rentals',
                'description' => 'Access essential medical equipment on rent. Ensures affordability and convenience.',
                'status'      => 1,
                'sort_order'  => 8,
            ],
            [
                'name'        => 'Industrial Equipment',
                'description' => 'Heavy-duty industrial equipment available for rent. Designed for various projects.',
                'status'      => 1,
                'sort_order'  => 9,
            ],
            [
                'name'        => 'Parking Rental',
                'description' => 'Secure parking spaces for rent. Perfect for vehicles of all types.',
                'status'      => 1,
                'sort_order'  => 10,
            ],
            [
                'name'        => 'Service Apartments & Short-Term Rentals',
                'description' => 'Fully furnished service apartments for short-term stays. Comfortable and convenient.',
                'status'      => 1,
                'sort_order'  => 11,
            ],
            [
                'name'        => 'Warehouse & Storage Facilities',
                'description' => 'Secure storage and warehouse facilities available. Suitable for personal or business use.',
                'status'      => 1,
                'sort_order'  => 12,
            ],
            [
                'name'        => 'Business License and Desk Rentals',
                'description' => 'Professional desk rentals and business licenses. Ideal for startups and freelancers.',
                'status'      => 1,
                'sort_order'  => 13,
            ],
            [
                'name'        => 'Equipment and Tool Rentals',
                'description' => 'Rent tools and equipment for DIY projects or professional use. Affordable and convenient.',
                'status'      => 1,
                'sort_order'  => 14,
            ],
            [
                'name'        => 'Bike and Scooter Rentals',
                'description' => 'Eco-friendly bike and scooter rentals for easy commuting. Flexible rental periods.',
                'status'      => 1,
                'sort_order'  => 15,
            ],
            [
                'name'        => 'Pet Services',
                'description' => 'Convenient rental services for pet care and related needs. Tailored to pet lovers.',
                'status'      => 1,
                'sort_order'  => 16,
            ],
            [
                'name'        => 'Marina Berths',
                'description' => 'Secure marina berths available for rent. Perfect for boat and yacht owners.',
                'status'      => 1,
                'sort_order'  => 17,
            ],
            [
                'name'        => 'Education Fees',
                'description' => 'Flexible rental solutions for education fees. Ensures easy access to learning.',
                'status'      => 1,
                'sort_order'  => 18,
            ],
            [
                'name'        => 'Fashion and Accessories Rentals',
                'description' => 'Trendy fashion and accessories available on rent. Perfect for events and daily wear.',
                'status'      => 1,
                'sort_order'  => 19,
            ],
        ];

        foreach ($rentTypes as $rentType) {
            DB::table('rent_types')->insert([
                'name'        => $rentType['name'],
                'slug'        => Str::slug($rentType['name'], '-'),
                'description' => $rentType['description'],
                'image'       => null,
                'status'      => $rentType['status'],
                'sort_order'  => $rentType['sort_order'],
            ]);
        }
    }
}
