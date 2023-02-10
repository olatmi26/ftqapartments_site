<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('propertyID', 6)->unique()->index()->nullable();
            $table->foreignId('category_id')->nullable()->index()->constrained()->onDelete('cascade');
            $table->foreignId('state_id')->nullable()->index()->constrained()->onDelete('cascade');
            $table->string('title')->nullable()->index();
            $table->string('location')->nullable()->index();
            $table->string('city')->nullable()->index();
            $table->string('nearByCities')->nullable()->index();
            $table->integer('number_of_room')->nullable()->index();
            $table->decimal('pricePerMonth', 7, 6)->nullable()->index();
            $table->decimal('pricePerYear', 7, 6)->nullable()->index();
            $table->string('description')->nullable()->index();
            $table->decimal('mapStreetLatitude', 7, 6)->nullable();
            $table->decimal('mapStreetLongitude', 7, 6)->nullable();
            $table->string('majorBusStop')->nullable()->index();
            $table->string('nearbyBusStop')->nullable()->index();
            $table->string('nearByShoppingMall')->nullable()->index();
            $table->boolean('availability')->nullable()->index();
            $table->foreignId('enteredBy')->nullable()->index()->constrained('users');
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
        Schema::dropIfExists('apartments');
    }
}
