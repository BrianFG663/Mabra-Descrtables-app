<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sale;
use App\Models\Sale_detail;
use Illuminate\Support\Facades\DB;

class SaleSeeder extends Seeder
{
    public function run()
    {
        DB::transaction(function () {
            Sale::factory(50)->create()->each(function ($sale) {
                $total = 0;
                $detailsCount = rand(1, 5);

                for ($i = 0; $i < $detailsCount; $i++) {
                    $detail = Sale_detail::factory()->make();

                    $detail->sales_id = $sale->id;
                    $detail->save();

                    $total += $detail->cantidad * $detail->precio_unitario;
                }

                $sale->total = $total;
                $sale->save();
            });
        });
    }
}