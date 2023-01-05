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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            //
            $table->unsignedBigInteger('chat_type_id');
            //
            $table->unsignedBigInteger('sender_user_id');
            $table->unsignedBigInteger('sender_person_company_id');
            $table->unsignedBigInteger('sender_user_type_id');
            //
            $table->unsignedBigInteger('receiver_user_id');
            $table->unsignedBigInteger('receiver_person_company_id');
            $table->unsignedBigInteger('receiver_user_type_id');
            //
            $table->dateTime('chat_date')->nullable();
            $table->text('message')->nullable();
            $table->boolean('read_status')->default(false)->nullable();
            $table->dateTime('read_date')->nullable();
            //
            $table->string('key_value_one', 100)->nullable();
            $table->string('key_value_two', 100)->nullable();
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
        Schema::dropIfExists('chats');
    }
};
