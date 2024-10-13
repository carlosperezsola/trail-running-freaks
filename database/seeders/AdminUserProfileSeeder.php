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
        $thirdParty->shop_name = 'Trail Running Freaks';
        $thirdParty->phone = '+34689657824';
        $thirdParty->email = 'admin_user@gmail.com';
        $thirdParty->address = 'C. Alcalde Francisco Caballero, 23, 50015 Zaragoza';
        $thirdParty->description = 'shop description';
        $thirdParty->user_id = $user->id;
        $thirdParty->save();
    }
}
