<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQAUserPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q_a_user_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('qa_user');
            $table->integer('photo_number');
            $table->timestamps();
            $table->foreign('qa_user')->references('id')->on('q_a_users')->onDelete('cascade');
        });
        DB::statement("ALTER TABLE q_a_user_photos ADD qa_photo LONGBLOB");        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('q_a_user_photos');
    }
}
