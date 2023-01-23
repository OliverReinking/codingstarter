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
        Schema::create('webinars', function (Blueprint $table) {
            $table->id();
            //
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('webinar_image_id')->default(1);
            //
            $table->string('title', 100);
            $table->text('description');
            $table->date('event_date')->nullable();
            $table->string('event_start', 100)->nullable();
            //
            $table->string('access', 200);
            $table->string('access_start', 200);
            $table->string('access_moderator', 200);
            //
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('webinars');
    }
};
