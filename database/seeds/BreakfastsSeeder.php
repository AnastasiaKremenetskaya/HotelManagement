<?php

use App\Breakfast;
use Illuminate\Database\Seeder;

class BreakfastsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $breakfasts = [
            [
                'type' => 'EB',
                'time' => '09:00:00',
            ],
            [
                'type' => 'CB',
                'time' => '08:00:00',
            ],
            [
                'type' => 'UAI',
                'time' => '10:00:00',
            ]
        ];//id	classification	roominess	price	description	image

        foreach ($breakfasts as $breakfast) {
            Breakfast::create(array(
                'type' => $breakfast['type'],
                'time' => $breakfast['time'],
            ));
        }
    }
}
