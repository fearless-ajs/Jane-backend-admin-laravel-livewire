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
        Schema::create('company_catalogues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('company_id')->constrained('companies');
            $table->enum('type', ['product', 'service']);

            $table->bigInteger('updated_by')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->string('brand')->nullable();;
            $table->string('category')->nullable();
            $table->bigInteger('price');
            $table->bigInteger('vat')->nullable(); // percentage
            $table->bigInteger('quantity')->nullable();;
            $table->bigInteger('previous_price')->nullable();
            $table->string('manufacturer')->nullable();
            $table->boolean('available')->default(0);
            $table->text('description');
            $table->boolean('shipping_fee')->nullable()->default(0);
            $table->bigInteger('money_back_days')->nullable();
            $table->bigInteger('warranty_period')->nullable(); // Supplied in months
            $table->boolean('active')->default(true);

            $table->bigInteger('billing_cycle')->nullable()->default(null); // Lined with ID of the billing cycle

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
        Schema::dropIfExists('company_catalogues');
    }
};
