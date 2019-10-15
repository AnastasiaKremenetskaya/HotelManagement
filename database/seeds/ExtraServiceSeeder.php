<?php

use App\ExtraService;
use Illuminate\Database\Seeder;

class ExtraServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $extra_services = [
            [
                'name' => 'Массаж головы',
                'price' => 980.00
            ],
            [
                'name' => 'Массаж ступней',
                'price' => 980.00
            ],
            [
                'name' => 'Вечерняя пицца в номер',
                'price' => 980.00
            ],
            [
                'name' => 'Посещение бани',
                'price' => 980.00
            ]
        ];//id	classification	roominess	price	description	image

        foreach ($extra_services as $extra_service) {
            ExtraService::create(array(
                'name' => $extra_service['name'],
                'price' => $extra_service['price'],
            ));
        }
    }
}
