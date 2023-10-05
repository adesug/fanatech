<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inventory;
use Carbon\Carbon;

class CreateInventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Inventory::create(
            [
                'code'  => 'b1111',
                'name'  => 'Buku tulis',
                'price' =>  5000,
                'stock' =>  100,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        Inventory::create(
            [
                'code'  => 'b2222',
                'name'  => 'Bolpoint',
                'price' =>  8000,
                'stock' =>  100,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        );
        Inventory::create(
            [
                'code'  => 'b3333',
                'name'  => 'Penggaris',
                'price' =>  3000,
                'stock' =>  100,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        );
        
    }
}
