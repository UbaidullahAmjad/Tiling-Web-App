<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('category_id')->nullable()->default(0);
            $table->integer('subcategory_id')->nullable()->default(0);
            $table->integer('warehouse_id')->nullable()->default(0);
            $table->text('name')->nullable();
            $table->float('min_quantity', 10, 0)->nullable();
            $table->text('slug')->nullable();
            $table->string('sku')->nullable();
            $table->text('tags')->nullable();
            $table->text('sort_details')->nullable();
            $table->text('details')->nullable();
            $table->string('photo')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->tinyInteger('status')->nullable()->default(1);
            $table->timestamps();
            $table->string('thumbnail')->nullable();
            $table->string('item_type')->default('normal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
