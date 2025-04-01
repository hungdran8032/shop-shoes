<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductStockTable extends Migration
{
    public function up()
    {
        Schema::create('product_stock', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('productId');
            $table->unsignedBigInteger('sizeId');
            $table->unsignedBigInteger('colorId');
            $table->integer('quantity')->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_stock');
    }
}