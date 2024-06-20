<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VendorShopProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'vendor@gmail.com')->first();

        $vendor = new Vendor();
        $vendor->shop_name = 'Vendor Shop';
        $vendor->phone = '12321312';
        $vendor->email = 'vendor@gmail.com';
        $vendor->description = 'shop description';
        $vendor->user_id = $user->id;
        $vendor->status = 1;

        $vendor->save();
    }
}
