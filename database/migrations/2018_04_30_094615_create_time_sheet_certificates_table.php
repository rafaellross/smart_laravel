<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeSheetCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_sheet_certificates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('time_sheet_id');            
            $table->integer('certificate_number');            
            $table->timestamps();
            $table->foreign('time_sheet_id')->references('id')->on('time_sheets')->onDelete('cascade');
        });
        DB::statement("ALTER TABLE time_sheet_certificates ADD certificate_img LONGBLOB");        
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_sheet_certificates');
    }
}
