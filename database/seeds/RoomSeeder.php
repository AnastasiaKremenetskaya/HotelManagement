<?php

use App\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()//Apartment', 'Business', 'Balcony', 'ExecutiveFloor
    {
        $rooms = [
            [
                'classification' => 'Apartment',
                'roominess' => 3,
                'price' => 980.00,
                'description' => '2000 sqft, 3 king sized beds, full kitchen.',
                'image' => 'https://placeimg.com/640/480/arch'
            ],
            [
                'classification' => 'Business',
                'roominess' => 2,
                'price' => 980.00,
                'description' => 'Two queen beds.',
                'image' => 'https://placeimg.com/640/480/arch'

            ],
            [
                'classification' => 'Balcony',
                'roominess' => 5,
                'price' => 380.00,
                'description' => 'International luxurious room.',
                'image' => 'https://placeimg.com/640/480/arch'

            ],
            [
                'classification' => 'ExecutiveFloor',
                'roominess' => 5,
                'price' => 1380.00,
                'description' => 'Usual luxurious room.',
                'image' => 'https://placeimg.com/640/480/arch'

            ],
            [
                'classification' => 'ExecutiveFloor',
                'roominess' => 5,
                'price' => 1380.00,
                'description' => 'One ultra wide king bed, full kitchen.',
                'image' => 'https://placeimg.com/640/480/arch'

            ]
        ];//id	classification	roominess	price	description	image

        foreach ($rooms as $room) {
            Room::create(array(
                'classification' => $room['classification'],
                'roominess' => $room['roominess'],
                'price' => $room['price'],
                'description' => $room['description'],
                'image' => $room['image']
            ));
        }
    }
}
