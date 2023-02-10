<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apartment_id')->nullable()->index()->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->index()->constrained()->onDelete('cascade');
            $table->foreignId('cart_id')->nullable()->index()->constrained()->onDelete('cascade');
            $table->date('dateNeeded')->nullable()->index();
            $table->date('dateToArrive')->nullable()->index();
            $table->date('dateToParkin')->nullable()->index();
            $table->boolean('AcceptingTerms')->nullable()->index();
            $table->double('amountPaid', 8, 2)->nullable()->index();
            $table->boolean('status')->nullable()->index();
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
        Schema::dropIfExists('bookings');
    }
}
