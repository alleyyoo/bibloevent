<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTableTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_table_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_table_id');
            $table->string('locale');
            $table->string('title');
            $table->longText('attr');

            $table->unique([ 'product_table_id', 'locale' ]);
            $table->foreign('product_table_id')->references('id')->on('product_tables')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_table_translations', function (Blueprint $table) {
            $table->dropForeign('product_table_translations_product_table_id_foreign');
        });
        Schema::dropIfExists('product_table_translations');
    }
}
