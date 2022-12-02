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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('business')->unique();
            $table->string('logo')->nullable();
            $table->string('p_iva_business', 11)->nullable();
            $table->string('address_business')->nullable();
            $table->string('telephone_business')->nullable();
            $table->string('mobile_phone_business')->nullable();
            $table->string('email_business')->nullable();
            $table->string('pec_business')->nullable();
            $table->string('type_business')->nullable();
            $table->date('start_contract')->nullable();
            $table->date('end_contract')->nullable();
            $table->tinyInteger('discount')->nullable();
            $table->string('subdomain')->nullable()->unique();
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
        Schema::dropIfExists('businesses');
    }
};
