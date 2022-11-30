<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtraSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('is_t4_slider')->nullable()->default(1);
            $table->tinyInteger('is_t4_featured_banner')->nullable()->default(1);
            $table->tinyInteger('is_t4_specialpick')->nullable()->default(1);
            $table->tinyInteger('is_t4_3_column_banner_first')->nullable()->default(1);
            $table->tinyInteger('is_t4_flashdeal')->nullable()->default(1);
            $table->tinyInteger('is_t4_3_column_banner_second')->nullable()->default(1);
            $table->tinyInteger('is_t4_popular_category')->nullable()->default(1);
            $table->tinyInteger('is_t4_2_column_banner')->nullable()->default(1);
            $table->tinyInteger('is_t4_blog_section')->nullable()->default(1);
            $table->tinyInteger('is_t4_brand_section')->nullable()->default(1);
            $table->tinyInteger('is_t4_service_section')->nullable()->default(1);
            $table->tinyInteger('is_t3_slider')->nullable()->default(1);
            $table->tinyInteger('is_t3_service_section')->nullable()->default(1);
            $table->tinyInteger('is_t3_3_column_banner_first')->nullable()->default(1);
            $table->tinyInteger('is_t3_popular_category')->nullable()->default(1);
            $table->tinyInteger('is_t3_flashdeal')->nullable()->default(1);
            $table->tinyInteger('is_t3_3_column_banner_second')->nullable()->default(1);
            $table->tinyInteger('is_t3_pecialpick')->nullable()->default(1);
            $table->tinyInteger('is_t3_brand_section')->nullable()->default(1);
            $table->tinyInteger('is_t3_2_column_banner')->nullable()->default(1);
            $table->tinyInteger('is_t3_blog_section')->nullable()->default(1);
            $table->tinyInteger('is_t2_slider')->nullable()->default(1);
            $table->tinyInteger('is_t2_service_section')->nullable()->default(1);
            $table->tinyInteger('is_t2_3_column_banner_first')->nullable()->default(1);
            $table->tinyInteger('is_t2_flashdeal')->nullable()->default(1);
            $table->tinyInteger('is_t2_new_product')->nullable()->default(1);
            $table->tinyInteger('is_t2_3_column_banner_second')->nullable()->default(1);
            $table->tinyInteger('is_t2_featured_product')->nullable()->default(1);
            $table->tinyInteger('is_t2_bestseller_product')->nullable()->default(1);
            $table->tinyInteger('is_t2_toprated_product')->nullable()->default(1);
            $table->tinyInteger('is_t2_2_column_banner')->nullable()->default(1);
            $table->tinyInteger('is_t2_blog_section')->nullable()->default(1);
            $table->tinyInteger('is_t2_brand_section')->nullable()->default(1);
            $table->timestamps();
            $table->tinyInteger('is_t1_falsh')->nullable()->default(1);
            $table->tinyInteger('is_t2_falsh')->nullable()->default(1);
            $table->tinyInteger('is_t3_falsh')->nullable()->default(1);
            $table->tinyInteger('is_t4_falsh')->nullable()->default(1);
            $table->tinyInteger('is_t2_three_column_category')->nullable()->default(1);
            $table->tinyInteger('is_t3_three_column_category')->nullable()->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extra_settings');
    }
}
