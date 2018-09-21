<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('columns', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('row_id')->unsigned()->index();
            $table->foreign('row_id')->references('id')->on('rows')->onDelete('cascade');
            $table->integer('element_type_id')->unsigned()->index();
            $table->foreign('element_type_id')->references('id')->on('element_types')->onDelete('cascade');
            $table->string('column_size')->nullable();
            $table->string('custom_class')->nullable();
            $table->tinyInteger('sorting')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('columns');
    }
}
