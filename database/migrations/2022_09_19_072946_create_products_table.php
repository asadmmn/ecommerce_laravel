<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); 
            $table->string('product_name'); // Changed to 'product_name'
            $table->text('product_description'); // Changed to 'product_description'
            $table->decimal('product_price', 10, 2); // Changed to 'product_price'
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('user_id'); // Added 'user_id'
            $table->string('product_image'); // Added 'product_image'
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('user_id')->references('id')->on('users'); // Added foreign key for user_id
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
