<?php

namespace Database\Seeders;

use App\Models\ThirdParty;
use Illuminate\Database\Seeder;
use App\Models\User;

class ThirdPartyUserShopProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'third_party_user@gmail.com')->first();

        $thirdParty = new ThirdParty();
        $thirdParty->banner = 'uploads/1343.jpg';
        $thirdParty->shop_name = 'Vendor Shop';
        $thirdParty->phone = '12321312';
        $thirdParty->email = 'third_party_user@gmail.com';
        $thirdParty->address = 'Usa';
        $thirdParty->description = 'shop description';
        $thirdParty->user_id = $user->id;
        $thirdParty->status = 1;

        $thirdParty->save();
    }
}
