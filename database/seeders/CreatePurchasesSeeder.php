<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Purchases;

class CreatePurchasesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Purchases::create(
            [
                'number' => '121212',
                'date' => '2023-10-06',
                'user_id' => 3,
            ]
            );
    }
    
}
