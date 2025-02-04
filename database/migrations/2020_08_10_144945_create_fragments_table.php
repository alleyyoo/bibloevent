<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFragmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fragments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key');
            $table->timestamps();
        });

        Schema::create('fragment_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('fragment_id');
            $table->string('locale')->index();
            $table->string('value');

            $table->unique([ 'fragment_id', 'locale' ]);
            $table->foreign('fragment_id')->references('id')->on('fragments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fragments');
    }
}
