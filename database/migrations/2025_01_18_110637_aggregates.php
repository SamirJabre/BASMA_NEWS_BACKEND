<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aggregates', function (Blueprint $table) {
            $table->id();
            $table->integer('navigation_clicks');
            $table->integer('hero_section_clicks');
            $table->integer('news_categories_clicks');
            $table->integer('most_read_clicks');
            $table->integer('footer_clicks');
            $table->integer('unique_navigation_clicks');
            $table->integer('unique_hero_section_clicks');
            $table->integer('unique_news_categories_clicks');
            $table->integer('unique_most_read_clicks');
            $table->integer('unique_footer_clicks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
