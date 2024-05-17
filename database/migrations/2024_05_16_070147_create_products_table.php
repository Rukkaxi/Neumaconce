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
            $table->decimal('price', 10, 2); // Adjust precision and scale as needed
            $table->unsignedBigInteger('brandId'); // Foreign key for brand (assuming it's linked to another table)
            $table->integer('stock')->default(0); // Default stock to 0
            $table->string('image')->nullable(); // Store image path
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
