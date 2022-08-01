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
        Schema::create('recurring_catalogue_payment_histories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('catalogue_id');
            $table->bigInteger('active_service_id');
            $table->dateTime('last_payment_date');
            $table->float('last_payment_amount');
            $table->dateTime('next_due_date');
            $table->boolean('active')->default(false);
            $table->boolean('charge_attempted')->default(false);
            $table->float('amount_charged')->default(0.00);

            $table->enum('charge_attempt_status', ['pending', 'succeeded', 'failed']);
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
        Schema::dropIfExists('recurring_catalogue_payment_histories');
    }
};
