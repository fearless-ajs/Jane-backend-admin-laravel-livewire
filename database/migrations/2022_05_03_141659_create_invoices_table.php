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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id');
            $table->bigInteger('contact_id');
            $table->bigInteger('worker_id');
            $table->bigInteger('creator_id');


            $table->dateTime('date_issued');
            $table->dateTime('due_date');

            $table->bigInteger('products_total_price');
            $table->bigInteger('services_total_price');

            $table->text('note')->nullable();

            $table->string('status'); // sent or draft
            $table->boolean('signed')->default(false);
            $table->string('signature_code')->nullable();
            $table->bigInteger('last_updated_by_id');

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
        Schema::dropIfExists('invoices');
    }
};
