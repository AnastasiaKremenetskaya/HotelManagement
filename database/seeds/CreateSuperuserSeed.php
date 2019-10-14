<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class CreateSuperuserSeed extends Seeder
{
    /**

     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pass = "12345678";
        $user = User::create([
            'name' => "Admin",
            'surname' => "",
            'patronymic' => "",
            'citizenship' => "",
            'date_of_birth' => '2019-10-14',
            'is_vip' => true,
            'phone' => '01121975',
            'email' => "admin@db.ru",
            'password' => Hash::make($pass),
            'email_verified_at' => Carbon::now()
        ]);

        $admin = new Role();
        $admin->name = 'admin';
        $admin->display_name = 'Администратор';
        $admin->description  = 'Администратор проекта';
        $admin->save();
        $user->attachRole($admin);
    }
}
