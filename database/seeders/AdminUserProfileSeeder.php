<?php

namespace Database\Seeders;

use App\Models\ThirdParty;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'admin_user@gmail.com')->first();

        $thirdParty = new ThirdParty;
        $thirdParty->banner = 'uploads/1343.jpg';
        // $thirdParty->shop_name = 'Admin Shop';
        $thirdParty->phone = '12321312';
        $thirdParty->email = 'admin_user@gmail.com';
        $thirdParty->address = 'Usa';
        $thirdParty->description = 'shop description';
        $thirdParty->user_id = $user->id;
        $thirdParty->save();
    }
}
