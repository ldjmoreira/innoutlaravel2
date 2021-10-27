<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DateTime;
use App\Http\Controllers\date_utils;
use App\Working_hour;
use Exception;
class Monthly_reportController extends Controller
{
    public function __construct()
    {
     //   $this->middleware('auth');
    }
    public function index()
    {
        $currentDate = new DateTime();
        $selectedUserId=Auth()->user()->id;
        $users = \App\User::All();
        $selectedPeriod = $currentDate->format('Y-m');
        
        $periods = $this->selectionYear();
        $registries = static::getMonthlyReport($selectedUserId, $selectedPeriod) ;

        $report = [];
        $workDay = 0;
        $sumOfWorkedTime = 0;
        $lastDay = date_utils::getLastDayOfMonth($selectedPeriod)->format('d');
        //-------



        for($day =1; $day <=$lastDay; $day++){
            $date = $selectedPeriod . '-' .sprintf('%02d',$day);

            if(date_utils::isPastWorkday($date)) $workDay++;
            try {
                $registry = $registries[$date];

                $sumOfWorkedTime += $registry->worked_time;
                array_push($report, $registry);
            } catch (Exception $e) {
                $workingHours = new Working_hour;
                $workingHours->work_date = 0;
                $workingHours->worked_time =0;

                array_push($report, $workingHours);
            }   
            
            /*
            if($registry){
                $sumOfWorkedTime += $registry->worked_time;
                array_push($report, $registry);
            }else{
                $workingHours = new Working_hour;
                $workingHours->work_date = 0;
                $workingHours->worked_time =0;

                array_push($report, $workingHours);
               
            }
            */
        }
        //-----
        $expectedTime = $workDay*60*60*8;
        $balance = date_utils::getTimeStringFromSeconds(abs($sumOfWorkedTime - $expectedTime));
        $sign = ($sumOfWorkedTime >= $expectedTime) ? '+' : '-';
        $sumOfWorkedTime = date_utils::getTimeStringFromSeconds($sumOfWorkedTime);

        return view('admin.monthly.Monthly_report')->with('report', $report)
        ->with('sumOfWorkedTime', $sumOfWorkedTime)
        ->with('balance', "{$sign}{$balance}")
        ->with('periods', $periods)
        ->with('selectedUserId', $selectedUserId)
        ->with('selectedPeriod', $selectedPeriod)
        ->with('users', $users);
        

    }
    public  function selectionYear()
    {
        $periods = [];

        for($yearDiff =0; $yearDiff<=2; $yearDiff++){// a seleção de que ano quer, faz lista
            $year = date('Y') - $yearDiff;
            for($month =12; $month >=1; $month--){
                $date = new DateTime("{$year}-{$month}-1");

                $periods[$date->format('Y-m')] = date_utils::strftimeBRA('%B de %Y', $date->getTimestamp());
            }
        }
        return $periods;
    }
    public static function getMonthlyReport($userId, $date) 
    {
        $registries = [];
        $startDate = date_utils::getFirstDayOfMonth($date)->format('Y-m-d');
        $endDate = date_utils::getLastDayOfMonth($date)->format('Y-m-d');
       
        
        $results = \App\Working_hour::where('user_id', Auth()->user()->id)
        ->whereBetween('work_date', [$startDate, $endDate])
        ->get();

        
        foreach($results as $result){
            $registries[$result->work_date] = $result;
        }
        return $registries;
    }

    public function post(Request $request)
    {

    }
}
