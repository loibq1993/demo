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
        Schema::create('exam_user_answers', function (Blueprint $table) {
            $table->id();
            $table->integer('question_id');
            $table->integer('answer_id')->nullable();
            $table->text('answer_by_text')->nullable();
            $table->integer('order_answer')->nullable()->default(null);
            $table->boolean('is_true_answer')->nullable()->default(false);
            $table->integer('user_exam_id')->nullable();
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
        Schema::dropIfExists('exam_user_answers');
    }
};
