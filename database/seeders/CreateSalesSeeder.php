<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sales;
use Carbon\Carbon;

class CreateSalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sales::create(
            [
                'number' => '121212',
                'date' => '2023-10-06',
                'user_id' => 2,
            ]
            );
    }
}
