<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFireMatricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fire_matrices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reference')->nullable();            
            $table->longText('service_type')->nullable();            
            $table->longText('wall_type')->nullable();            
            $table->longText('wall_type_ref')->nullable();            
            $table->longText('fire_stop_sys')->nullable();            
            $table->string('test_report_ref')->nullable();            
            $table->longText('test_specimen')->nullable();            
            $table->string('frl_achieved')->nullable();            
            $table->date('test_dt')->nullable();            
            $table->longText('comments')->nullable();            
            $table->string('approval_status')->nullable();            

            $table->timestamps();
        });

        DB::statement("ALTER TABLE fire_matrices ADD picture LONGBLOB NULL");        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fire_matrices');
    }
}
