<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Working_hour extends Model
{
     // ele vai procurar working_hours
    // protected $table = 'workingHours' //caso vc queira que ele procure outro nome no DB
    protected $fillable = ['user_id','work_date','time1','time2','time3','time4','worked_time'];
    public function user(){
        return $this->belongsTo(User::class);
      //  return $this->belongsTo(User::class,'usuario_id'); 
    }
}
