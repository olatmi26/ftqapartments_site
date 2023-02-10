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
            $table->string('username')->nullable()->index();
            $table->string('firstName')->nullable();
            $table->string('middleName')->nullable();
            $table->string('surName')->nullable();
            $table->string('contactPhone', 14)->unique()->nullable()->index();
            $table->string('gender', 1)->index();
            $table->string('role')->index()->nullable()->default('customer');
            $table->string('email')->unique();
            $table->string('currentAddress')->nullable()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};