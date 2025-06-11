<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name'); // название конфигурации
            $table->string('product_type'); // штора / тюль / римская / покрывало
            $table->decimal('width');
            $table->decimal('height');
            $table->unsignedBigInteger('fabric_id');
            $table->unsignedBigInteger('sewing_type_id')->nullable(); // для штор
            $table->string('quilting_method')->nullable(); // для покрывала
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('fabric_id')->references('id')->on('fabrics')->onDelete('cascade');
            $table->foreign('sewing_type_id')->references('id')->on('sewing_types')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configurations');
    }
}
