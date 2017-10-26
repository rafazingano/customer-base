<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKitItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kit_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->integer('amount')->nullable();;
            $table->integer('kit_id')->unsigned();            
            $table->foreign('kit_id')
                    ->references('id')
                    ->on('kits')
                    ->onDelete('cascade');
            $table->integer('customer_id')->nullable()->unsigned();            
            $table->foreign('customer_id')
                    ->references('id')
                    ->on('customers')
                    ->onDelete('cascade');
            $table->integer('kit_item_id')->nullable()->unsigned();            
            $table->foreign('kit_item_id')
                    ->references('id')
                    ->on('kit_items')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('kit_items');
    }
}
