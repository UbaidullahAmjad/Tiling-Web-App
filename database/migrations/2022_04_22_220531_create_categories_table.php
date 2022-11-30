<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('photo')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_descriptions')->nullable();
            $table->tinyInteger('status')->nullable()->default(1);
            $table->tinyInteger('is_feature')->nullable()->default(1);
            $table->integer('serial')->default(0);
            $table->timestamps();
            $table->text('description')->nullable();
            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->text('short_description')->nullable();
            $table->text('second_description')->nullable();
            $table->string('second_title')->nullable();
            $table->text('second_short_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
