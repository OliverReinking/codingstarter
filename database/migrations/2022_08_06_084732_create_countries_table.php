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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            //
            $table->string('name', 100)->nullable();
            $table->string('alpha_2', 2)->nullable();
            $table->string('alpha_3', 3)->nullable();
            $table->string('country_code', 10)->nullable();
            $table->string('iso_3166_2', 20)->nullable();
            $table->string('region', 50)->nullable();
            $table->string('sub_region', 50)->nullable();
            $table->string('intermediate_region', 50)->nullable();
            $table->string('region_code', 10)->nullable();
            $table->string('sub_region_code', 10)->nullable();
            $table->string('intermediate_region_code', 10)->nullable();
            //
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
        Schema::dropIfExists('countries');
    }
};
