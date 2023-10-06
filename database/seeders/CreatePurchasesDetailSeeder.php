<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Purchases_detail;

class CreatePurchasesDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Purchases_detail::create(
            [
                'purchases_id' => 1,
                'inventory_id' => 1,
                'qty' => 123,
                'price' => 5000.00,
            ]
        );
    }
}
