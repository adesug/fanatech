<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sales_detail;

class CreateSalesDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sales_detail::create(
            [
                'sales_id' => 1,
                'inventory_id' => 1,
                'qty' => 123,
                'price' => 5000.00,
            ]
            );
    }
}
