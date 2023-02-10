<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apartment_id')->nullable()->index()->constrained()->onDelete('cascade');
            $table->foreignId('booking_id')->nullable()->index()->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->index()->constrained()->onDelete('cascade');
            $table->double('amount')->nullable()->index();
            $table->string('paymentMethod')->nullable()->index();
            $table->string('ref')->nullable()->index();
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
        Schema::dropIfExists('payments');
    }
}
