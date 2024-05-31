<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->integer('year');
            $table->unsignedBigInteger('brandId');
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('brandId')->references('id')->on('brands');
        });
    }

    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
