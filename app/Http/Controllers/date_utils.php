<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use DateTimeImmutable;
class date_utils extends Controller
{
    private static  $monthss= ["janeiro","fevereiro",
    "março","abril","maio","junho","julho","agosto",
    "setembro","outubro","novembro","dezembro"];

 

   

    private static $weekdayss = ["domingo","segunda","terça",
    "quarta","quinta","sexta","sabado"];

    public static function strftimeBRA($format, $timestamp){
        preg_match_all('/%([a-zA-Z])/', $format, $results);

        $originals = $results[0];
        $factors = $results[1];

        foreach($factors as $key=>$factor){

            switch($factor){
                case 'a':
                    /*** Abbreviated textual representation of the day ***/
                    $n = date('w', $timestamp); // number of the weekday (0 for sunday, 6 for saturday);
                    $replace = ucfirst(static::$weekdayss[$n]); 
                    $replace = substr($replace, 0, 3);
                    break;
                case 'A':
                    /*** Full textual representation of the day ***/
                    $n = date('w', $timestamp); // number of the weekday (0 for sunday, 6 for saturday);
                    $replace = ucfirst(static::$weekdayss[$n]);
                    break;
                case 'h':
                case 'b':
                    /*** Abbreviated month name ***/
                    $n = date('n', $timestamp); // Numeric representation of a month, without leading zeros
                    $replace = ucfirst(static::$monthss[$n-1]);
                    $replace = substr($replace, 0, 3);
                    break;
                case 'B':
                    /*** Full month name ***/
                    $n = date('n', $timestamp); // Numeric representation of a month, without leading zeros

                    $replace = ucfirst(static::$monthss[$n-1]);

                    break;
                default:
                    /*** Use standard strftime function ***/
                    $replace = strftime("%".$factor, $timestamp);
                    break;
            }
            $search = $originals[$key];
            $format = str_replace($search, $replace, $format);
        }
        return $format;
    }
    
   public static function getDateAsDateTime($date) {
        return is_string($date) ? new DateTime($date) : $date;
    }
    public static function isWeekend($date) {
        $inputDate = static::getDateAsDateTime($date);
        return $inputDate->format('N') >= 6;
    }
    public static function isBefore($date1, $date2) {
        $inputDate1 = static::getDateAsDateTime($date1);
        $inputDate2 = static::getDateAsDateTime($date2);
        return $inputDate1 <= $inputDate2;
    }
    public static function getNextDay($date) {
        $inputDate = static::getDateAsDateTime($date);
        $inputDate->modify('+1 day');
        return $inputDate;
    }
    public static function sumIntervals($interval1,$interval2){
        $date = new DateTime('00:00:00');
        $date->add($interval1);
        $date->add($interval2);
    
        return (new DateTime('00:00:00'))->diff($date);
    }
    
    public static function subtractIntervals($interval1,$interval2){
        $date = new DateTime('00:00:00');
        $date->add($interval1);
        $date->sub($interval2);
    
        return (new DateTime('00:00:00'))->diff($date);
    }
    
    public static function getDateFromInterval($interval){
        return new DateTimeImmutable($interval->format('%H:%i:%s'));
    }
    public static function getDateFromString($str){
        return DateTimeImmutable::createFromFormat('H:i:s', $str);
    }
    
    public static function getFirstDayOfMonth($date){
        $time = static::getDateAsDateTime($date)->getTimestamp();
        return new DateTime(date('Y-m-1',$time));
    }
    public static function getLastDayOfMonth($date){
        $time = static::getDateAsDateTime($date)->getTimestamp();
        return new DateTime(date('Y-m-t',$time));
    }
    public static function getSecondsFromDateInterval($interval){
        $d1 = new DateTimeImmutable();
        $d2 = $d1->add($interval);
        return $d2->getTimestamp() - $d1->getTimestamp();
    }
    public static function isPastWorkday($date) {//retornará verdadeiro ou falso
        return !static::isWeekend($date) && static::isBefore($date, new DateTime());
    }
    public static function getTimeStringFromSeconds($seconds){
        $h = intdiv($seconds,3600);
        $m = intdiv($seconds % 3600,60);
        $s = $seconds - ($h*3600) - ($m*60);
        return sprintf('%02d:%02d:%02d', $h, $m, $s);
    }
    public static function formatDateWithLocale($date, $pattern){
        $time = static::getDateAsDateTime($date)->getTimesTamp();
        return static::strftimeBRA($pattern, $time);
    }
}


