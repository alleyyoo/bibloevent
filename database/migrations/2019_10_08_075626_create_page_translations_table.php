<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('page_id');
            $table->string('locale')->index();
            $table->string('slug')->nullable();
            $table->boolean('is_visible')->default(true);
            $table->boolean('is_menu')->default(true);
            $table->string('title');
            $table->text('body')->nullable();

            $table->unique([ 'page_id', 'locale' ]);
            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('page_translations', function (Blueprint $table) {
            $table->dropForeign('page_translations_page_id_foreign');
        });
        Schema::dropIfExists('page_translations');
    }
}
