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
            $table->string('vat')->nullable(); // percentage
            $table->string('category')->nullable();
            $table->string('price')->nullable();
            $table->string('usage_unit')->nullable();
            $table->string('unit_number')->nullable();
            $table->text('description');
            $table->string('money_back_days')->nullable();
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
        Schema::dropIfExists('services');
    }
};
