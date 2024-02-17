<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TechnicalSpecifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Thong so ki thuat cua san pham
        Schema::create('technical_specifications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('value');
            $table->foreignId('product_id')->constrained();
            // Các trường khác nếu cần
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warranty_polices');
    }
}
