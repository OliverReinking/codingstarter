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
        Schema::create('newsletter_members', function (Blueprint $table) {
            $table->id();
            //
            $table->unsignedBigInteger('newsletter_id');
            //
            $table->string('name', 100)->nullable();
            $table->string('email', 100);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('uuid')->nullable();
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
        Schema::dropIfExists('newsletter_members');
    }
};
