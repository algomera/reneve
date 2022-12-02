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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained('businesses')->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('ref');
            $table->string('content');
            $table->float('price', 6, 2);
            $table->string('type');
            $table->string('treatment');
            $table->string('product_line');
            $table->integer('qta');
            $table->boolean('put_of_print')->default(false);
            $table->tinyInteger('discount')->nullable();
            $table->boolean('price_visible')->default(true);
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
        Schema::dropIfExists('products');
    }
};
