<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rows', function (Blueprint $table) {
            $table->id('id');
            $table->morphs('rowable');
            $table->string('custom_class')->nullable();
            $table->integer('sorting')->unsigned()->index();
            $table->boolean('expanded')->default(false);
            $table->string('alignment')->nullable();
            $table->string('padding_top')->nullable();
            $table->string('padding_bottom')->nullable();
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
        Schema::dropIfExists('rows');
    }
}
