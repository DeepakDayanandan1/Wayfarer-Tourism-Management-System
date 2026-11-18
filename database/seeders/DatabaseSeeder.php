<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Default Admin if not exists
        if (!DB::table('admin')->where('UserName', 'admin')->exists()) {
            DB::table('admin')->insert([
                'UserName' => 'admin',
                'Name' => 'Administrator',
                'EmailId' => 'admin@wayfarer.com',
                'MobileNumber' => '9876543210',
                'Password' => Hash::make('Test@123'),
                'updationDate' => now(),
            ]);
        }

        // Default Pages
        $defaultPages = [
            'terms' => '<p align="justify"><strong>Terms and Conditions</strong><br>Welcome to Wayfarer. By browsing our website and booking our expeditions, you agree to comply with and be bound by the terms and conditions outlined here. All reservations are subject to confirmation and verified travel credentials.</p>',
            'privacy' => '<p align="justify"><strong>Privacy Policy</strong><br>At Wayfarer, we respect your privacy and are committed to protecting your personal data. We collect only the information necessary to fulfill your travel bookings and provide personalized concierge support. We never sell your personal information to third parties.</p>',
            'aboutus' => '<div><p align="justify"><strong>Welcome to Wayfarer Expeditions!</strong><br>Since our inception, our courteous and committed team of travel experts has ensured seamless, enjoyable, and unforgettable tours for travelers worldwide. Wayfarer is recognized as a premier travel solutions provider, curating bespoke adventures suited to every explorer\'s budget and taste.</p></div>',
            'contact' => '<div><p align="justify"><strong>Wayfarer Concierge Headquarters</strong><br>Address: Wayfarer House, Central Promenade, Suite 400<br>Phone: +91 98765 43210<br>Email: concierge@wayfarer.com<br>Support: Available 24/7 for all booked explorers</p></div>',
        ];

        foreach ($defaultPages as $type => $detail) {
            if (!DB::table('tblpages')->where('type', $type)->exists()) {
                DB::table('tblpages')->insert([
                    'type' => $type,
                    'detail' => $detail,
                ]);
            }
        }
    }
}

