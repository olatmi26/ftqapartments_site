<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('contact_us', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable()->index();
            $table->string('fullName')->nullable()->index();
            $table->longText('message')->nullable()->index();
            $table->string('subject')->nullable()->index();
            $table->string('phone', 14)->nullable()->index();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_us');
    }
}
