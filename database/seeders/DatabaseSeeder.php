<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVideo;
use App\Models\Promotion;
use App\Models\WarrantyPolicy;
use App\Models\TechnicalSpec;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()->count(10)->create();
        Product::factory()->count(10)->create();
        Promotion::factory()->count(10)->create();
        WarrantyPolicy::factory()->count(10)->create();
        TechnicalSpec::factory()->count(10)->create();
    }
}
