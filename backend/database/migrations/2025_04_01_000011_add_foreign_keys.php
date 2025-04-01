<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeys extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('brandId')->nullable()->after('description');
            $table->unsignedBigInteger('categoryId')->nullable()->after('brandId');
            $table->foreign('brandId')->references('id')->on('brands')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('categoryId')->references('id')->on('categories')->onDelete('set null')->onUpdate('cascade');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('addressId')->nullable()->after('totalPrice');
            $table->foreign('addressId')->references('id')->on('addresses')->onDelete('set null')->onUpdate('cascade');
        });

        Schema::table('carts', function (Blueprint $table) {
            $table->unsignedBigInteger('productId')->nullable()->after('isPayed');
            $table->unsignedBigInteger('brandId')->nullable()->after('productId');
            $table->unsignedBigInteger('userId')->nullable()->after('brandId');
            $table->unsignedBigInteger('orderId')->nullable()->after('userId');
            $table->foreign('productId')->references('id')->on('products')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('brandId')->references('id')->on('brands')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('userId')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('orderId')->references('id')->on('orders')->onDelete('set null')->onUpdate('cascade');
        });

        Schema::table('images', function (Blueprint $table) {
            $table->foreign('productId')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('product_stock', function (Blueprint $table) {
            $table->foreign('productId')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sizeId')->references('id')->on('sizes')->onUpdate('cascade');
            $table->foreign('colorId')->references('id')->on('colors')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['brandId']);
            $table->dropForeign(['categoryId']);
            $table->dropColumn('brandId');
            $table->dropColumn('categoryId');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['addressId']);
            $table->dropColumn('addressId');
        });

        Schema::table('carts', function (Blueprint $table) {
            $table->dropForeign(['productId']);
            $table->dropForeign(['brandId']);
            $table->dropForeign(['userId']);
            $table->dropForeign(['orderId']);
            $table->dropColumn(['productId', 'brandId', 'userId', 'orderId']);
        });

        Schema::table('images', function (Blueprint $table) {
            $table->dropForeign(['productId']);
        });

        Schema::table('product_stock', function (Blueprint $table) {
            $table->dropForeign(['productId']);
            $table->dropForeign(['sizeId']);
            $table->dropForeign(['colorId']);
        });
    }
}