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
        Schema::create('person_companies', function (Blueprint $table) {
            $table->bigIncrements('id')->startingValue(1000);
            //
            $table->string('person_company_number', 100)->nullable();
            //
            $table->boolean('is_natural_person')->nullable()->default(true);
            //
            $table->string('name', 100)->nullable();
            $table->string('street', 100)->nullable();
            $table->integer('country_id')->default(1);
            $table->string('postcode', 20)->nullable();
            $table->string('city', 100)->nullable();
            //
            $table->integer('contactperson_salutation_id')->default(1);
            $table->string('contactperson_first_name', 100)->nullable();
            $table->string('contactperson_last_name', 100)->nullable();
            $table->string('contactperson_phone', 100)->nullable();
            $table->string('contactperson_email', 100)->nullable();
            //
            $table->string('bankconnection_iban', 255)->nullable();
            $table->string('bankconnection_accountholder', 255)->nullable();
            //
            $table->string('billing_address', 100)->nullable();
            $table->string('billing_address_line_2', 100)->nullable();
            $table->string('billing_street', 100)->nullable();
            $table->integer('billing_country_id')->nullable();
            $table->string('billing_postcode', 20)->nullable();
            $table->string('billing_city', 100)->nullable();
            //
            $table->boolean('is_deleted')->nullable()->default(false);
            $table->text('delete_history')->nullable();
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
        Schema::dropIfExists('companies');
    }
};
