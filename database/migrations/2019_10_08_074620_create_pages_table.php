<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sort_id')->default(0);
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('category_id')->nullable();
            $table->string('front_layout')->nullable();
            $table->string('front_view')->nullable();
            $table->string('back_layout')->nullable();
            $table->string('back_view')->nullable();
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->unsignedInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')->references('id')->on('pages')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropForeign('pages_category_id_foreign');
            $table->dropForeign('pages_created_by_foreign');
            $table->dropForeign('pages_updated_by_foreign');
            $table->dropForeign('pages_deleted_by_foreign');
        });
        Schema::dropIfExists('pages');
    }
}
