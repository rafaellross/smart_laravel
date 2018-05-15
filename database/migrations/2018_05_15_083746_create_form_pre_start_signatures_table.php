<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormPreStartSignaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_pre_start_signatures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->integer('number');
            $table->unsignedInteger('prestart_id');
            $table->timestamps();
            $table->foreign('prestart_id')->references('id')->on('form_pre_starts')->onDelete('cascade');
        });
        
        DB::statement("ALTER TABLE form_pre_start_signatures ADD signature LONGBLOB NULL DEFAULT NULL");        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_pre_start_signatures');
    }
}
