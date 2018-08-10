<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrecedentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('precedents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number');
            $table->text('body');
            $table->string('slug')->unique();
            $table->timestamp('segregated_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('suspended_at')->nullable();
            $table->timestamp('canceled_at')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->text('pending_resources')->nullable();
            $table->text('additional_info')->nullable();
            $table->timestamps();

            $table->unsignedInteger('court_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('branch_id');
        });

        DB::statement('ALTER TABLE precedents ADD FULLTEXT fulltext_index' . '(number, body)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('precedents');
    }
}
