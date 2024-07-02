<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Division;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array = [
            'Marketing & Sales',
            'HC & GA',
            'Operational & Procurement',
            'Finance Accounting & Tax'
        ];

        foreach($array as $data){
            Division::create([
                'division_name' => $data
            ]);
        }
    }
}
