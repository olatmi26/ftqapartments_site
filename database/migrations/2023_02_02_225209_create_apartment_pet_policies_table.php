<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentPetPoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('apartment_pet_policies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apartment_id')->nullable()->index()->constrained()->onDelete('cascade');
            $table->foreignId('pet_policies_id')->nullable()->constrained('pet_policies')->index();
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
        Schema::dropIfExists('apartment_pet_policies');
    }
}
