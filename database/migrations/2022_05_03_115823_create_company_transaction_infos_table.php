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
        Schema::create('company_transaction_infos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id');
            $table->string('country');
            $table->string('bank_name');
            $table->bigInteger('account_number');
            $table->string('company_banking_id')->nullable();
            $table->string('iban')->nullable();
            $table->string('swift_code')->nullable();
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
        Schema::dropIfExists('company_transaction_infos');
    }
};
