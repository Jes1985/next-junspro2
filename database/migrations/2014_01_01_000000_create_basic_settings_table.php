<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('basic_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('uniqid')->default(12345);
            $table->string('favicon')->nullable();
            $table->string('logo')->nullable();
            $table->string('website_title')->nullable();
            $table->string('email_address')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('address')->nullable();
            $table->decimal('latitude', 8, 5)->nullable();
            $table->decimal('longitude', 8, 5)->nullable();
            $table->smallInteger('theme_version')->unsigned()->default(1);
            $table->string('base_currency_symbol')->nullable();
            $table->string('base_currency_symbol_position', 20)->nullable();
            $table->string('base_currency_text', 20)->nullable();
            $table->string('base_currency_text_position', 20)->nullable();
            $table->decimal('base_currency_rate', 8, 2)->nullable();
            $table->string('primary_color', 30)->nullable();
            $table->string('secondary_color', 30)->nullable();
            $table->string('breadcrumb_overlay_color', 30)->nullable();
            $table->decimal('breadcrumb_overlay_opacity', 4, 2)->nullable();
            $table->tinyInteger('smtp_status')->nullable();
            $table->string('smtp_host')->nullable();
            $table->integer('smtp_port')->nullable();
            $table->string('encryption', 50)->nullable();
            $table->string('smtp_username')->nullable();
            $table->string('smtp_password')->nullable();
            $table->string('from_mail')->nullable();
            $table->string('from_name')->nullable();
            $table->string('to_mail')->nullable();
            $table->string('breadcrumb')->nullable();
            $table->unsignedTinyInteger('disqus_status')->nullable();
            $table->string('disqus_short_name')->nullable();
            $table->tinyInteger('google_recaptcha_status')->nullable();
            $table->string('google_recaptcha_site_key')->nullable();
            $table->string('google_recaptcha_secret_key')->nullable();
            $table->unsignedTinyInteger('whatsapp_status')->nullable();
            $table->string('whatsapp_number', 20)->nullable();
            $table->string('whatsapp_header_title')->nullable();
            $table->unsignedTinyInteger('whatsapp_popup_status')->nullable();
            $table->text('whatsapp_popup_message')->nullable();
            $table->string('maintenance_img')->nullable();
            $table->tinyInteger('maintenance_status')->nullable();
            $table->text('maintenance_msg')->nullable();
            $table->string('bypass_token')->nullable();
            $table->string('footer_logo')->nullable();
            $table->string('admin_theme_version', 10)->default('light');
            $table->string('notification_image')->nullable();
            $table->string('google_adsense_publisher_id')->nullable();
            $table->string('hero_bg_img')->nullable();
            $table->string('about_section_image')->nullable();
            $table->string('about_section_video_link')->nullable();
            $table->string('feature_bg_img')->default('');
            $table->string('testimonial_bg_img')->default('');
            $table->string('qr_url')->nullable();
            $table->string('qr_image')->nullable();
            $table->string('qr_color')->default('000000');
            $table->unsignedInteger('qr_size')->default(250);
            $table->string('qr_style')->default('square');
            $table->string('qr_eye_style')->default('square');
            $table->unsignedInteger('qr_margin')->default(0);
            $table->string('qr_type')->default('default');
            $table->string('qr_inserted_image')->nullable();
            $table->unsignedInteger('qr_inserted_image_size')->default(20);
            $table->unsignedInteger('qr_inserted_image_x')->default(50);
            $table->unsignedInteger('qr_inserted_image_y')->default(50);
            $table->string('qr_text')->nullable();
            $table->string('qr_text_color')->default('000000');
            $table->unsignedInteger('qr_text_size')->default(15);
            $table->unsignedInteger('qr_text_x')->default(50);
            $table->unsignedInteger('qr_text_y')->default(50);
            $table->unsignedTinyInteger('facebook_login_status')->default(1);
            $table->string('facebook_app_id')->nullable();
            $table->string('facebook_app_secret')->nullable();
            $table->unsignedTinyInteger('google_login_status')->default(1);
            $table->string('google_client_id')->nullable();
            $table->string('google_client_secret')->nullable();
            $table->string('pusher_app_id')->nullable();
            $table->string('pusher_key')->nullable();
            $table->string('pusher_secret')->nullable();
            $table->string('pusher_cluster', 50)->nullable();
            $table->unsignedTinyInteger('support_ticket_status')->default(1);
            $table->string('hero_static_img')->nullable();
            $table->string('hero_video_url')->nullable();
            $table->string('newsletter_bg_img')->nullable();
            $table->string('cta_bg_img')->nullable();
            $table->tinyInteger('is_service')->default(1);
            $table->tinyInteger('is_language')->default(1);
            $table->integer('seller_email_verification')->default(0);
            $table->integer('seller_admin_approval')->default(0);
            $table->text('admin_approval_notice')->nullable();
            $table->integer('expiration_reminder')->default(0);
            $table->float('tax', 8, 2)->default(0.00);
            $table->string('chat_max_file')->default('0');
            $table->double('life_time_earning', 8, 2)->default(0);
            $table->double('total_profit', 8, 2)->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        // Données initiales
        DB::table('basic_settings')->insert([
            'uniqid'                    => 12345,
            'website_title'             => 'Junspro',
            'email_address'             => 'contact@junspro.com',
            'contact_number'            => '',
            'address'                   => '',
            'theme_version'             => 1,
            'base_currency_symbol'      => '€',
            'base_currency_symbol_position' => 'left',
            'base_currency_text'        => 'EUR',
            'base_currency_text_position' => 'left',
            'base_currency_rate'        => 1.00,
            'primary_color'             => '#7c3aed',
            'secondary_color'           => '#1e40af',
            'breadcrumb_overlay_color'  => '#000000',
            'breadcrumb_overlay_opacity'=> 0.50,
            'admin_theme_version'       => 'light',
            'feature_bg_img'            => '',
            'testimonial_bg_img'        => '',
            'qr_color'                  => '000000',
            'qr_size'                   => 250,
            'qr_style'                  => 'square',
            'qr_eye_style'              => 'square',
            'qr_margin'                 => 0,
            'qr_type'                   => 'default',
            'qr_inserted_image_size'    => 20,
            'qr_inserted_image_x'       => 50,
            'qr_inserted_image_y'       => 50,
            'qr_text_color'             => '000000',
            'qr_text_size'              => 15,
            'qr_text_x'                 => 50,
            'qr_text_y'                 => 50,
            'facebook_login_status'     => 0,
            'google_login_status'       => 0,
            'support_ticket_status'     => 1,
            'is_service'                => 1,
            'is_language'               => 1,
            'seller_email_verification' => 0,
            'seller_admin_approval'     => 0,
            'expiration_reminder'       => 0,
            'tax'                       => 0.00,
            'chat_max_file'             => '5',
            'life_time_earning'         => 0,
            'total_profit'              => 0,
            'smtp_status'               => 0,
            'maintenance_status'        => 0,
            'whatsapp_status'           => 0,
            'whatsapp_popup_status'     => 0,
            'disqus_status'             => 0,
            'google_recaptcha_status'   => 0,
            'created_at'                => now(),
            'updated_at'                => now(),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('basic_settings');
    }
};
