<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parameters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('business_name');
            $table->string('abn');
            $table->string('business_address');
            $table->string('business_suburb');
            $table->string('business_state');
            $table->string('business_post_code');
            $table->string('business_email');
            $table->string('business_contact');
            $table->string('business_phone');
            $table->boolean('business_no_abn')->nullable();
            $table->timestamps();            
        });
        DB::statement("ALTER TABLE parameters ADD business_signature LONGBLOB NULL DEFAULT NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parameters');
    }
}
