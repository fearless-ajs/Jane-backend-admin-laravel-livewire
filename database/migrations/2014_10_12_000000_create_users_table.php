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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('image')->nullable()->default('user-avatar.jpg');
            $table->enum('user_type', ['company-worker', 'contact', 'super-admin'])->default('company-worker');
            $table->bigInteger('parent_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('verification_token')->nullable();
            $table->string('password');
            $table->boolean('enabled')->default(true);
            $table->dateTime('last_login')->nullable();

            $table->boolean('enable_two_factor')->default(false);
            $table->string('two_factor_code')->nullable();
            $table->dateTime('two_factor_expires_at')->nullable();

            $table->bigInteger('company_id')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
