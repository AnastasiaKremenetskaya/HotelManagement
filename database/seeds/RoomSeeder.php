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
    public function run()
    {
        $rooms = [
            [
                'classification' => 'Apartment',
                'roominess' => 3,
                'price' => 980.00,
                'description' => '2000 sqft, 3 king sized beds, full kitchen.',
                'image' => 'https://qtxasset.com/styles/breakpoint_sm_default_480px_w/s3/hotelmanagement/1551371746/Hotel-Ottilia-Suite_bedroom.jpg?7sALV5nWzKBIQBnMDW3aEZWpSKuebHxn&itok=EJXatsv6'
            ],
            [
                'classification' => 'Business',
                'roominess' => 2,
                'price' => 980.00,
                'description' => 'Two queen beds.',
                'image' => 'https://o.aolcdn.com/images/dims3/GLOB/crop/2063x1353+1+570/resize/1028x675!/format/jpg/quality/85/https%3A%2F%2Fs.yimg.com%2Fos%2Fcreatr-images%2F2019-07%2F0990ecc0-b23e-11e9-b3d9-edcf534c3626'

            ],
            [
                'classification' => 'Balcony',
                'roominess' => 5,
                'price' => 380.00,
                'description' => 'International luxurious room.',
                'image' => 'https://media.cntraveler.com/photos/5c7567b6b36948415881db22/4:3/w_480,c_limit/Hotel-Ottilia-Junior-Suite.jpg'

            ],
            [
                'classification' => 'ExecutiveFloor',
                'roominess' => 5,
                'price' => 1380.00,
                'description' => 'Usual luxurious room.',
                'image' => 'https://2486634c787a971a3554-d983ce57e4c84901daded0f67d5a004f.ssl.cf1.rackcdn.com/the-dominick/media/cache/Dominick-Hotel-Accommodations-King-Guest-Room-2-5c005bac0bcf0-650x520.jpg'

            ],
            [
                'classification' => 'ExecutiveFloor',
                'roominess' => 5,
                'price' => 1380.00,
                'description' => 'One ultra wide king bed, full kitchen.',
                'image' => 'https://www.telegraph.co.uk/content/dam/Travel/hotels/europe/united-kingdom/Hotels%20-%20England/london/womb-room-london.jpg?imwidth=450'

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
