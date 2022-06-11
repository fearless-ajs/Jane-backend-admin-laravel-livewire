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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('updated_by')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->string('brand');
            $table->string('category');
            $table->bigInteger('price');
            $table->bigInteger('vat')->nullable(); // percentage
            $table->bigInteger('quantity');
            $table->bigInteger('previous_price')->nullable();
            $table->string('manufacturer');
            $table->boolean('available')->default(0);
            $table->text('description');
            $table->boolean('free_shipping')->default(0);
            $table->bigInteger('money_back_days')->nullable();
            $table->bigInteger('warranty_period')->nullable(); // Supplied in months
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
