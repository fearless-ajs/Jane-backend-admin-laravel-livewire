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
            $table->string('lastname');
            $table->string('firstname');
            $table->string('email');
            $table->string('image')->nullable();
            $table->foreignId('user_id');
            $table->foreignId('company_id');
            $table->enum('title', ['Mr', 'Miss', 'Mrs', 'Dr', 'Prof']);

            $table->string('office_phone')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('organization')->nullable();

            $table->string('fax')->nullable();
            $table->string('date_of_birth')->nullable();

            $table->string('city')->nullable();

            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('address')->nullable();
            $table->boolean('available')->default(true);
            $table->text('description');

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
        Schema::dropIfExists('contacts');
    }
};
