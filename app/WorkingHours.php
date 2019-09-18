<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkingHours extends Model
{
    static function getString($workingHourId)
    {
        $c = WorkingHours::where('id',$workingHourId)->count();
        if($c!=0)
        {
            $w = WorkingHours::where('id',$workingHourId)->get();
            return $w[0]['hours'];
        }
        else
        {
            return "";
        }
    }
}
