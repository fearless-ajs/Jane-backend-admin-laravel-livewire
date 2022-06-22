<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_catalogues', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('invoice_id');
            $table->bigInteger('catalogue_id');
            $table->bigInteger('quantity')->nullable();
            $table->bigInteger('unit_price')->nullable();
            $table->bigInteger('total_price')->nullable();
            $table->text('description')->nullable();
            $table->enum('type', ['product', 'service']);
            $table->softDeletes();
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
        Schema::dropIfExists('invoice_catalogues');
    }
};
