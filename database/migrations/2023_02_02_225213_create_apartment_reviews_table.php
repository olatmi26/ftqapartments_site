<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('apartment_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apartment_id')->nullable()->index()->constrained()->onDelete('cascade');
            $table->foreignId('reviewer')->nullable()->index()->constrained('users');
            $table->text('review')->nullable()->index();
            $table->integer('satisfaction')->nullable()->index();
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
        Schema::dropIfExists('apartment_reviews');
    }
}
