<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('attribute_id')->nullable();
            $table->string('name')->nullable();
            $table->double('price')->nullable()->default(0);
            $table->timestamps();
            $table->string('stock')->nullable()->default('unlimited');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->string('length')->nullable();
            $table->string('height')->nullable();
            $table->string('broad')->nullable();
            $table->bigInteger('quantity')->nullable();
            $table->string('item_number')->nullable();
            $table->string('material')->nullable();
            $table->string('used')->nullable();
            $table->string('format')->nullable();
            $table->string('surface')->nullable();
            $table->string('edge')->nullable();
            $table->string('weight_per_unit')->nullable();
            $table->string('box_contains')->nullable();
            $table->string('frost_resistance')->nullable();
            $table->string('synonyms')->nullable();
            $table->float('variable_quantity', 10, 0)->nullable();
            $table->unsignedBigInteger('item_id')->index('attribute_options_item_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_options');
    }
}
