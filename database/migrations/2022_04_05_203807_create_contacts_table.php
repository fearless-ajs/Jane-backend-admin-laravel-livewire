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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('created_by_id');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('company_id')->constrained('companies');
            $table->enum('title', ['Mr', 'Miss', 'Mrs', 'Dr', 'Prof']);

            $table->string('office_phone')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('organization');

            $table->string('fax')->nullable();
            $table->string('date_of_birth')->nullable();

            $table->string('city')->nullable();

            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('address')->nullable();
            $table->boolean('available')->default(true);
            $table->text('descriptions');

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
        Schema::dropIfExists('contacts');
    }
};
