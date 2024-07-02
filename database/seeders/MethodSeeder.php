<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Method;

class MethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array = [
            'Transfer',
            'Auto Debit',
            'Cash',
            'Lain Lain'
        ];

        foreach($array as $data){
            Method::create([
                'method_name' => $data
            ]);
        }
    }
}
