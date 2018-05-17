<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormServiceSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_service_sheets', function (Blueprint $table) {
            $table->increments('id');
            //Header
                //Customer
            $table->string('job_no')->nullable();
            $table->date('dt_form')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_address')->nullable();
            $table->string('requested_by')->nullable();
            $table->string('contact_no')->nullable();
                //Job
            $table->string('job_description')->nullable();
            $table->string('job_address')->nullable();
            $table->string('site_contact')->nullable();
            $table->string('site_contact_no')->nullable();

            //Authority 
            $table->string('read_understood')->nullable();
            $table->string('authority_name')->nullable();
            $table->date('authority_dt')->nullable();

            $table->text('description')->nullable();            

            //Materials
            $table->string('purchase_no_1')->nullable();            
            $table->string('purchase_no_2')->nullable();            
            $table->string('purchase_no_3')->nullable();            

            $table->string('material_no_1')->nullable();            
            $table->string('material_no_2')->nullable();            
            $table->string('material_no_3')->nullable();            
            
            //Time Sheet
            $table->date('time_sheet_dt_1')->nullable();
            $table->date('time_sheet_dt_2')->nullable();
            $table->date('time_sheet_dt_3')->nullable();
            $table->date('time_sheet_dt_4')->nullable();
            $table->date('time_sheet_dt_5')->nullable();

            $table->string('time_sheet_start_1')->nullable();                        
            $table->string('time_sheet_start_2')->nullable();                        
            $table->string('time_sheet_start_3')->nullable();                        
            $table->string('time_sheet_start_4')->nullable();                        
            $table->string('time_sheet_start_5')->nullable();                                                                        

            $table->string('time_sheet_end_1')->nullable();                        
            $table->string('time_sheet_end_2')->nullable();                        
            $table->string('time_sheet_end_3')->nullable();                        
            $table->string('time_sheet_end_4')->nullable();                        
            $table->string('time_sheet_end_5')->nullable();                                                                        

            $table->string('time_sheet_total_1')->nullable();                        
            $table->string('time_sheet_total_2')->nullable();                        
            $table->string('time_sheet_total_3')->nullable();                        
            $table->string('time_sheet_total_4')->nullable();                        
            $table->string('time_sheet_total_5')->nullable();                                                                        

            $table->string('time_sheet_initial_1')->nullable();                        
            $table->string('time_sheet_initial_2')->nullable();                        
            $table->string('time_sheet_initial_3')->nullable();                        
            $table->string('time_sheet_initial_4')->nullable();                        
            $table->string('time_sheet_initial_5')->nullable();                                                                        

            //Costings            
            $table->string('service_call')->nullable();                        
            $table->string('labour')->nullable();                                    
            $table->string('materials')->nullable();                                    
            $table->string('equipments')->nullable();                                    
            $table->string('as_per_quote')->nullable();                                    

            $table->float('service_call_value')->nullable();                        
            $table->float('labour_value')->nullable();                                    
            $table->float('materials_value')->nullable();                                    
            $table->float('equipments_value')->nullable();                                    
            $table->float('as_per_quote_value')->nullable();                                    
            $table->float('gst')->nullable();                                    
            $table->float('total')->nullable();                                    

            //Payment
            $table->string('pay_type')->nullable();                                    
            $table->string('card_cheque_no')->nullable();                                    
            $table->date('card_expiry_dt')->nullable();                                    
            $table->string('card_name')->nullable();                                    
            $table->string('card_id')->nullable();                                    
            $table->timestamps();
        });
            //Authority 
        DB::statement("ALTER TABLE form_service_sheets ADD authority_signature LONGBLOB NULL DEFAULT NULL");        
        DB::statement("ALTER TABLE form_service_sheets ADD tradesman_signature LONGBLOB NULL DEFAULT NULL");        
        DB::statement("ALTER TABLE form_service_sheets ADD customer_signature LONGBLOB NULL DEFAULT NULL");        
        DB::statement("ALTER TABLE form_service_sheets ADD payment_signature LONGBLOB NULL DEFAULT NULL");        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_service_sheets');
    }
}
