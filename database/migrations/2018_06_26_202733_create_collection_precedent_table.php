<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollectionPrecedentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_precedent', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('collection_id');
            $table->unsignedInteger('precedent_id');

            $table->timestamps();
            
            $table->unique(['collection_id', 'precedent_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collection_precedent');
    }
}
