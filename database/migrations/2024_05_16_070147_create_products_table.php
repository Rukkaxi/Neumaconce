<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->string('name');
            $table->integer('price')->nullable();
            $table->unsignedBigInteger('brandId'); // Foreign key for brand (assuming it's linked to another table)
            $table->integer('stock')->default(0); // Default stock to 0
            $table->text('description'); // Add description column
            $table->boolean('available')->default(true); // Add available column
            $table->string('image1')->nullable(); // Store image1 path
            $table->string('image2')->nullable(); // Store image2 path
            $table->string('image3')->nullable(); // Store image3 path
            $table->string('image4')->nullable(); // Store image4 path
            $table->string('image5')->nullable(); // Store image5 path
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('brandId')->references('id')->on('brands')->onDelete('cascade'); // Adjust table name if necessary
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
}
