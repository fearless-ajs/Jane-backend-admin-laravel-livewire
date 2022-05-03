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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies');
            $table->foreignId('user_id')->constrained('users');
            $table->bigInteger('updated_by')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->bigInteger('vat')->nullable(); // percentage
            $table->string('category');
            $table->bigInteger('price');
            $table->string('usage_unit');
            $table->bigInteger('unit_number');
            $table->text('description');
            $table->bigInteger('money_back_days')->nullable();
            $table->boolean('active')->default(true);
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
        Schema::dropIfExists('services');
    }
};
