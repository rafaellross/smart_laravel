<?php

namespace App;

 use Illuminate\Database\Eloquent\Model;
 use App\TimeSheet;
 use Carbon\Carbon;
 use App\Hour;


 class ExpensesMyob
 {
   public $obj;

   function __construct($empStdPay, $job)
 	{

 		$this->obj = $startPay;
    foreach ($empStdPay->PayrollCategories as $category) {
      if ($category->PayrollCategory->Type == "Expense" || $category->PayrollCategory->Type == "Superannuation") {
        $category->Job->UID = $job->myob_id;
        unset($category->Job->Number);
        unset($category->Job->Name);
        unset($category->Job->URI);
      }
    }

 	}
 }
