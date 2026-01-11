<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        $companies = [
            ['name' => 'Animax Studio', 'address' => 'Jl. Juanda No. 45, Samarinda', 'phone' => '(0541) 7654-3201'],
            ['name' => 'PixelMotion Creative', 'address' => 'Jl. Pahlawan No. 88, Samarinda', 'phone' => '(0541) 8993-1120'],
            ['name' => 'Visualink Animation', 'address' => 'Jl. Ahmad Yani No. 12, Samarinda', 'phone' => '(0541) 7812-445'],
            ['name' => 'Lensart Visual Studio', 'address' => 'Jl. S. Parman No. 20, Samarinda', 'phone' => '(0541) 7533-0032'],
            ['name' => 'CreativeHue Agency', 'address' => 'Jl. Antasari No. 17, Samarinda', 'phone' => '(0541) 9092-5501'],
            ['name' => 'Graphika Desainindo', 'address' => 'Jl. Lambung Mangkurat No. 9, Samarinda', 'phone' => '(0541) 7811-883'],
            ['name' => 'FotoKreatif Indonesia', 'address' => 'Jl. PM Noor No. 65, Samarinda', 'phone' => '(0541) 8845-9981'],
            ['name' => 'Softdev ID', 'address' => 'Jl. Suryanata No. 8, Samarinda', 'phone' => '(0541) 9987-221'],
            ['name' => 'BitCraft Indonesia', 'address' => 'Jl. KH Wahid Hasyim No. 118, Samarinda', 'phone' => '(0541) 8991-007'],
            ['name' => 'CodeNest Tech', 'address' => 'Jl. AW Syahranie No. 23, Samarinda', 'phone' => '(0541) 9987-221'],
            ['name' => 'Devloop Software House', 'address' => 'Jl. Pelita No. 14, Samarinda', 'phone' => '(0541) 8890-3311'],
            ['name' => 'NetSolve IT Solution', 'address' => 'Jl. Pulau Irian No. 55, Samarinda', 'phone' => '(0541) 7702-113'],
            ['name' => 'Infranet Nusantara', 'address' => 'Jl. DI Panjaitan No. 34, Samarinda', 'phone' => '(0541) 7655-9401'],
            ['name' => 'CyberLink Network', 'address' => 'Jl. A.M. Sangaji No. 29, Samarinda', 'phone' => '(0541) 8822-776'],
            ['name' => 'NetCore Indo', 'address' => 'Jl. Dr. Sutomo No. 101, Samarinda', 'phone' => '(0541) 7788-940'],
        ];

        foreach ($companies as $data) {
            $user = User::create([
                'name' => $data['name'],
                'username' => Str::slug($data['name'], ''),
                'password' => '12345678',
                'role' => 3,
            ]);

            Company::create([
                'name' => $data['name'],
                'address' => $data['address'],
                'phone' => $data['phone'],
                'limit' => 5,
                'user_id' => $user->id,
            ]);
        }
    }
}
