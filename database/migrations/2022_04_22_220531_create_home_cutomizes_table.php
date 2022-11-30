<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeCutomizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_cutomizes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('banner_first')->nullable();
            $table->text('banner_secend')->nullable();
            $table->text('banner_third')->nullable();
            $table->text('popular_category')->nullable();
            $table->text('two_column_category')->nullable();
            $table->text('feature_category')->nullable();
            $table->timestamps();
            $table->text('home_page4')->nullable();
            $table->text('home_4_popular_category')->nullable();
            $table->string('hero_banner')->nullable()->default('\\\'[]\\\'');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('home_cutomizes');
    }
}
