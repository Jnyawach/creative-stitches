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
            $table->timestamps();
            $table->string('name');
            $table->string('slug');
            $table->bigInteger('category_id')->unsigned()->index();
            $table->integer('stock')->default(0);
            $table->string('sku');
            $table->string('mpn');
            $table->integer('productable_id');
            $table->string('productable_type');
            $table->text('description');
            $table->float('price',8,2);
            $table->integer('status')->default(0);
            $table->mediumText('meta_description');
            $table->mediumText('keywords');
            $table->integer('total_stitches');
            $table->bigInteger('size_id')->index()->unsigned();
            $table->string('design_size_inches');
            $table->string('design_size_mm');
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
