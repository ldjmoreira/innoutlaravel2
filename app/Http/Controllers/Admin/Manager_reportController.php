<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\date_utils;
use DateTime;
use DB;
class Manager_reportController extends Controller
{
    public function __construct()
    {
     //   $this->middleware('auth');
    }
    public function index()
    {  
       // $today2 =(new DateTime())->format('Y-m-d');
      // $today =new DateTime();
        $activeUsersCount = \App\User::all()->count();
    
        
        $absentUsers = \App\User::select('name')
        ->where('end_date',NULL)
        ->whereNotIn('id', function ($query) {
            $today2 =(new DateTime())->format('Y-m-d');
            $query->select('user_id')->from('working_hours')
            ->where('work_date',$today2)
            ->whereNotNull('time1') ;
        })
        ->get();
      //  dd();
        $seconds = $this->getWorkedTime();
        $hoursInMonth = explode(':', date_utils::getTimeStringFromSeconds($seconds))[0];
    
        //dd($absentUsers);

        return view('admin.manager.Manager_report')
        ->with('activeUsersCount', $activeUsersCount)
        ->with('absentUsers', $absentUsers)
        ->with('hoursInMonth', $hoursInMonth);
    }

    public static function getWorkedTime(){
        $yearAndMonth = (new DateTime())->format('Y-m');
        $startDate = (new DateTime("{$yearAndMonth}-1"))->format('Y-m-d');
        $endDate = date_utils::getLastDayOfMonth($yearAndMonth)->format('Y-m-d');
       

    $objSeconds = \App\Working_hour::select(DB::raw('SUM(worked_time) as sum'))
            ->where('created_at', NULL)
            ->whereBetween('work_date', [$startDate, $endDate])
         //   ->where('hide_from_customers', 0)
            ->get();

        $result = $objSeconds[0]->sum;
    
        return $result;
    }
}
