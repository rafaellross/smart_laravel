<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ApprenticeEmail;
use Illuminate\Support\Facades\Mail;
use DB;
class MailController extends Controller
{
    public function send()
    {

        $employees = DB::select(
                    DB::raw(
                        "select emp.id,
                                emp.name,
                                emp.phone,
                                emp.dob,
                                case
                                when emp.location = 'P' then 'Plumber'
                                when emp.location = 'O' then 'Office'
                                when emp.location = 'A' then 'Apprentice'
                                when emp.location = 'L' then 'Labourer'
                                end location,
                                emp.anniversary_dt,
                                emp.apprentice_year,
                                CAST(emp.rdo_bal AS DECIMAL(12,2)) as rdo_bal,
                                CAST(emp.pld AS DECIMAL(12,2)) as pld,
                                CAST(emp.anl AS DECIMAL(12,2)) as anl,
                                if(YEARWEEK(emp.anniversary_dt) = YEARWEEK((SELECT week_end_timesheet FROM parameters LIMIT 1))-1, 1, 0) as rollover,
                                (select id from time_sheets where employee_id = emp.id and YEARWEEK(week_end) = YEARWEEK((SELECT week_end_timesheet FROM parameters LIMIT 1)) order by id desc limit 1) as last_timesheet
                                from employees emp
                                where
                                if(YEARWEEK(emp.anniversary_dt) = YEARWEEK((SELECT week_end_timesheet FROM parameters LIMIT 1))-1, 1, 0) = 1
                                order by emp.name asc
                         ")
                    );

        if (count($employees) > 0) {
          Mail::to("raf@smartplumbingsolutions.com.au")->send(new ApprenticeEmail($employees));
        }

    }
}
