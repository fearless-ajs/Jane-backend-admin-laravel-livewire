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
            $table->string('country')->nullable();
            $table->string('bank_name')->nullable();
            $table->bigInteger('account_number')->nullable();
            $table->string('company_banking_id')->nullable();
            $table->string('iban')->nullable();
            $table->string('swift_code')->nullable();
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
        Schema::dropIfExists('company_transaction_infos');
    }
};
