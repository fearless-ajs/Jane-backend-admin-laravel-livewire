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
            $table->string('invoice_code');
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

            $table->boolean('paid')->default(false);
            $table->float('amount_paid')->default(0);
            $table->float('total_tax')->default(0);
            $table->float('total_price_with_tax')->default(0);
//
//            $table->bigInteger('last_updated_by_id');

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
        Schema::dropIfExists('invoices');
    }
};
