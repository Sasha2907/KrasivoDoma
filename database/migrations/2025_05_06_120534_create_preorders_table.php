<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preorders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('description')->nullable();
            $table->string('status')->default('pending'); // pending, approved, replied
            $table->text('admin_message')->nullable();
            $table->timestamps();
        });
    
        Schema::create('preorder_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('preorder_id')->constrained()->onDelete('cascade');
            $table->morphs('item'); // item_type & item_id (Product or Configuration)
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
        Schema::dropIfExists('preorders');
    }
}
