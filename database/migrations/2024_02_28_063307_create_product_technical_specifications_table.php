<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTechnicalSpecificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_technical_specifications', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('technical_specification_id');
            // Add other columns if necessary
            $table->primary(['product_id', 'technical_specification_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void¡
     */
    public function down()
    {
        Schema::dropIfExists('product_technical_specifications');
    }
}
