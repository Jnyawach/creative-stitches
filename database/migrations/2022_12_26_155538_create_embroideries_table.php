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
        Schema::create('embroideries', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('file_name');
            $table->bigInteger('product_id')->unsigned()->index();
            $table->bigInteger('format_id')->unsigned()->index();
            $table->foreign('product_id')->references('id')
                ->on('products')->cascadeOnDelete();
            $table->foreign('format_id')->references('id')
                ->on('formats')->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('embroideries');
    }
};
