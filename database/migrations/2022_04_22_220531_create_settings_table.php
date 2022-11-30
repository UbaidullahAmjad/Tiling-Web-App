<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('loader')->nullable();
            $table->tinyInteger('is_loader')->nullable()->default(1);
            $table->string('feature_image')->nullable();
            $table->string('primary_color')->nullable();
            $table->tinyInteger('smtp_check')->nullable()->default(0);
            $table->string('email_host')->nullable();
            $table->string('email_port')->nullable();
            $table->string('email_encryption')->nullable();
            $table->string('email_user')->nullable();
            $table->string('email_pass')->nullable();
            $table->string('email_from')->nullable();
            $table->string('email_from_name')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('version')->nullable();
            $table->text('overlay')->nullable();
            $table->string('google_analytics_id')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->tinyInteger('is_shop')->nullable()->default(1);
            $table->tinyInteger('is_blog')->nullable()->default(1);
            $table->tinyInteger('is_faq')->nullable()->default(1);
            $table->tinyInteger('is_contact')->nullable()->default(1);
            $table->tinyInteger('facebook_check')->nullable()->default(1);
            $table->string('facebook_client_id')->nullable();
            $table->string('facebook_client_secret')->nullable();
            $table->string('facebook_redirect')->nullable();
            $table->tinyInteger('google_check')->nullable()->default(1);
            $table->string('google_client_id')->nullable();
            $table->string('google_client_secret')->nullable();
            $table->string('google_redirect')->nullable();
            $table->double('min_price')->nullable()->default(0);
            $table->double('max_price')->nullable()->default(100000);
            $table->string('footer_phone')->nullable();
            $table->text('footer_address')->nullable();
            $table->string('footer_email')->nullable();
            $table->string('footer_gateway_img')->nullable();
            $table->text('social_link')->nullable();
            $table->string('friday_start')->nullable();
            $table->string('friday_end')->nullable();
            $table->string('satureday_start')->nullable();
            $table->string('satureday_end')->nullable();
            $table->string('copy_right')->nullable();
            $table->tinyInteger('is_slider')->nullable()->default(1);
            $table->tinyInteger('is_category')->nullable()->default(1);
            $table->tinyInteger('is_product')->nullable()->default(1);
            $table->tinyInteger('is_top_banner')->nullable()->default(1);
            $table->tinyInteger('is_recent')->nullable()->default(1);
            $table->tinyInteger('is_top')->nullable()->default(1);
            $table->tinyInteger('is_best')->nullable()->default(1);
            $table->tinyInteger('is_flash')->nullable()->default(1);
            $table->tinyInteger('is_brand')->nullable()->default(1);
            $table->tinyInteger('is_blogs')->nullable()->default(1);
            $table->tinyInteger('is_campaign')->nullable()->default(1);
            $table->tinyInteger('is_brands')->nullable()->default(1);
            $table->tinyInteger('is_bottom_banner')->nullable()->default(1);
            $table->tinyInteger('is_service')->nullable()->default(1);
            $table->string('campaign_title')->nullable();
            $table->string('campaign_end_date')->nullable();
            $table->tinyInteger('campaign_status')->nullable()->default(1);
            $table->string('twilio_sid')->nullable();
            $table->string('twilio_token')->nullable();
            $table->string('twilio_form_number')->nullable();
            $table->string('twilio_country_code')->nullable();
            $table->tinyInteger('is_announcement')->nullable()->default(1);
            $table->string('announcement')->nullable();
            $table->decimal('announcement_delay', 11)->default(0);
            $table->tinyInteger('is_maintainance')->nullable()->default(1);
            $table->string('maintainance_image')->nullable();
            $table->text('maintainance_text')->nullable();
            $table->tinyInteger('is_twilio')->nullable()->default(0);
            $table->text('twilio_section')->nullable();
            $table->timestamps();
            $table->tinyInteger('is_three_c_b_first')->default(1);
            $table->tinyInteger('is_popular_category')->default(1);
            $table->tinyInteger('is_three_c_b_second')->default(1);
            $table->tinyInteger('is_highlighted')->default(1);
            $table->tinyInteger('is_two_column_category')->default(1);
            $table->tinyInteger('is_popular_brand')->default(1);
            $table->tinyInteger('is_featured_category')->default(1);
            $table->tinyInteger('is_two_c_b')->default(1);
            $table->string('theme')->nullable();
            $table->string('google_recaptcha_site_key')->nullable();
            $table->string('google_recaptcha_secret_key')->nullable();
            $table->tinyInteger('recaptcha')->nullable()->default(0);
            $table->tinyInteger('currency_direction')->nullable()->default(1);
            $table->text('google_analytics')->nullable();
            $table->text('google_adsense')->nullable();
            $table->text('facebook_pixel')->nullable();
            $table->text('facebook_messenger')->nullable();
            $table->tinyInteger('is_google_analytics')->nullable()->default(0);
            $table->tinyInteger('is_google_adsense')->nullable()->default(0);
            $table->tinyInteger('is_facebook_pixel')->nullable()->default(0);
            $table->tinyInteger('is_facebook_messenger')->nullable()->default(0);
            $table->text('announcement_link')->nullable();
            $table->tinyInteger('is_attribute_search')->nullable()->default(1);
            $table->tinyInteger('is_range_search')->nullable()->default(1);
            $table->integer('view_product')->nullable()->default(12);
            $table->string('home_page_title')->nullable()->default('Home');
            $table->tinyInteger('is_privacy_trams')->nullable()->default(1);
            $table->string('policy_link')->nullable()->default('\\\'#\\\'');
            $table->string('terms_link')->nullable()->default('\\\'#\\\'');
            $table->tinyInteger('is_guest_checkout')->nullable()->default(1);
            $table->text('custom_css')->nullable();
            $table->string('announcement_title')->nullable();
            $table->string('announcement_type')->nullable()->default('banner');
            $table->tinyInteger('is_cookie')->nullable()->default(1);
            $table->string('cookie_text')->nullable();
            $table->text('announcement_details')->nullable();
            $table->string('decimal_separator')->nullable()->default('.');
            $table->string('thousand_separator')->nullable()->default(',');
            $table->text('disqus')->nullable();
            $table->tinyInteger('is_disqus')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
