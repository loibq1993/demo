<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_full_answers', function (Blueprint $table) {
            $table->id();
            $table->integer('full_answer_id');
            $table->integer('answer_type')->nullable();
            $table->string('full_text_answer')->nullable()->default(null);
            $table->integer('limit_text')->nullable();
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
        Schema::dropIfExists('detail_full_answers');
    }
};
