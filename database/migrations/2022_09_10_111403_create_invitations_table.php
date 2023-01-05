<?php

use App\Models\Invitation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            //
            $table->unsignedBigInteger('person_company_id');
            //
            $table->string('first_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->string('email', 200)->nullable();
            $table->string('application', 50)->nullable();
            $table->string('uuid', 255)->nullable();
            $table->string('status', 50)->default(Invitation::STATUS_NOT_YET_ACCEPTED)->nullable();
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
        Schema::dropIfExists('invitations');
    }
};
