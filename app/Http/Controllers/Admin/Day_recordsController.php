<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DateTime;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Controllers\date_utils;
use App\Working_hour;
class Day_recordsController extends Controller
{
  //  private $today;
  //  private $workingHours =[] ;

    public function __construct()
    {
    //    $this->middleware('auth'); //conf na rota
        $this->today = $this->firstOne();
     //   $this->workingHours = $this->loadFromUserAndDate();
    }
    public function index()
    {
      
       // dd($workingHours);
        $today = $this->today;
        $workingHours = $this->loadFromUserAndDate();
       // $workingHours = \App\Working_hour::where([['user_id',\Auth::id()],['work_date',date('Y-m-d')]])->get();
       // dd($workingHours);
        return view('admin.day.Day_records')->with('today', $today)->with('workingHours', $workingHours);
    }
    public static function firstOne(){
       // $date2=Carbon::now();
        $date = (new DateTime())->getTimestamp();//new \DateTime(); se nao tiver o use
        return    date_utils::strftimeBRA('%d de %B de %Y', $date);
       // return  $today = self::strftimeBRA('%d de %B de %Y', $date);
      
    }
    public static function loadFromUserAndDate(){
        
        $workingHours = \App\Working_hour::where([['user_id',Auth()->user()->id],['work_date',date('Y-m-d')]])->get();
       // dd(date('Y-m-d'));
        return $workingHours ;
    }
    

    public function innout2(Request $request)
    {
       // $currentTime = date_utils::strftimeBRA('%H:%M:%S',time());
      //  $algo = $this->execInnout($currentTime);
      $data = \App\Working_hour::where([['user_id', Auth()->user()->id],['work_date',date('Y-m-d')]])->get();
      if(isset($data[0]->id)) {
        $currentTime = $request->forcedTime;
        $algo = $this->execInnout($data,$currentTime);
        flash('feito com sucesso!')->success();
        
        return redirect()->route('Day_records');
      }else{
        $workingHours = new Working_hour;
   
        $currentTime = $request->forcedTime;

        $workingHours->user_id = Auth()->user()->id;

        $workingHours->work_date = date('Y-m-d');
        $workingHours->time1 = $currentTime;
        $workingHours->worked_time =0;
        $workingHours->save();

        flash('feito com sucesso!')->success();
        return redirect()->route('Day_records');
      }
    }
    
    public function innout()
    {
       // $currentTime = date_utils::strftimeBRA('%H:%M:%S',time());
      //  $algo = $this->execInnout($currentTime);
      $data = \App\Working_hour::where([['user_id', Auth()->user()->id],['work_date',date('Y-m-d')]])->get();
     
      if(isset($data[0]->id)) {
        $algo = $this->execInnout($data);

        flash('feito com sucesso!')->success();
        return redirect()->route('Day_records');
      } else {

        $workingHours = new Working_hour;
   
        $workingHours->user_id = Auth()->user()->id;
        $workingHours->work_date = date('Y-m-d');
        $workingHours->time1 = date("H:i:s");
        $workingHours->worked_time =0;
        $workingHours->save();

        flash('feito com sucesso!')->success();
        return redirect()->route('Day_records');

      }
      
      
    }
    public  function execInnout($data,$currentTime=0)
    {
        
        $timeColumn = static::getNextTime($data);
        if(!$timeColumn){
           // throw new AppException("Você já fez os 4 batimentos do dia!");
           flash('Você já fez os 4 batimentos do dia!')->error();
           return redirect()->route('Day_records');
        }
       // $data = \App\Working_hour::where([['user_id', Auth()->user()->id],['work_date',date('Y-m-d')]])->get();
       
       $workingHours = \App\Working_hour::find($data[0]->id);
       
       
       $workingHours->user_id = Auth()->user()->id;
       $workingHours->work_date = date('Y-m-d');

       if($currentTime==0) {
            // if($timeColumn == "time1"){$workingHours->time1 = date("H:i:s");}
            if($timeColumn == "time2"){$workingHours->time2 = date("H:i:s");}
            if($timeColumn == "time3"){$workingHours->time3 = date("H:i:s");}
            if($timeColumn == "time4"){$workingHours->time4 = date("H:i:s");}
        }else{
            if($timeColumn == "time2"){$workingHours->time2 = $currentTime;}
            if($timeColumn == "time3"){$workingHours->time3 = $currentTime;}
            if($timeColumn == "time4"){$workingHours->time4 = $currentTime;}
        }
      
       

       
       $workingHours->worked_time = date_utils::getSecondsFromDateInterval($this->getWorkedInterval($workingHours));
    return   $workingHours->save();

    //   $id = $data[0]->id;
     //   dd($id);

    }
    public  function getWorkedInterval($workingHours) 
    {
        [$t1, $t2, $t3, $t4] = $this->getTimes($workingHours);

        $part1 = new \DateInterval('PT0S');
        $part2 = new \DateInterval('PT0S');

        if($t1) $part1 = $t1->diff(new DateTime());
        if($t2) $part1 = $t1->diff($t2);
        if($t3) $part2 = $t3->diff(new DateTime());
        if($t4) $part2 = $t3->diff($t4);

        return date_utils::sumIntervals($part1, $part2);
    }
    public  function getTimes($workingHours) 
    {
        $times = [];
        


        $workingHours->time1 ? array_push($times,date_utils::getDateFromString($workingHours->time1)) : array_push($times,null);
        $workingHours->time2 ? array_push($times,date_utils::getDateFromString($workingHours->time2)) : array_push($times,null);
        $workingHours->time3 ? array_push($times,date_utils::getDateFromString($workingHours->time3)) : array_push($times,null);
        $workingHours->time4 ? array_push($times,date_utils::getDateFromString($workingHours->time4)) : array_push($times,null);
       


        return $times;
    }

    public static function getNextTime($data)
    {
     //   $data = \App\Working_hour::where([['user_id', Auth()->user()->id],['work_date',date('Y-m-d')]])->get();
       
       if(!($data[0]->time1)) return 'time1';
       if(!($data[0]->time2)) return 'time2';
       if(!($data[0]->time3)) return 'time3';
       if(!($data[0]->time4)) return 'time4';
       return null;
    }
   
}
