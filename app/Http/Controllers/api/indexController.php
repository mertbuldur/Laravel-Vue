<?php

namespace App\Http\Controllers\api;

use App\Appointment;
use App\WorkingHours;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class indexController extends Controller
{
    public function getWorkingHours($date = '')
    {
       $date = ($date=='') ? date("Y-m-d") : $date;
       $returnArray = [];
       $hours = WorkingHours::all();
       foreach ($hours as $k => $v)
       {
           $control = Appointment::where('date',$date)
           ->where('workingHour',$v['id'])->count();
           $v['isActive'] = ($control == 0) ? true : false;
           $returnArray[] = $v;
       }
       return response()->json($returnArray);
    }

    public function appointmentStore(Request $request)
    {
        $returnArray = [];
        $returnArray['status'] = false;
        $all = $request->except('_token');
        $control = Appointment::where('date',$all['date'])->where('workingHour',$all['workingHour'])->count();
        if($control != 0 ) {
            $returnArray['message'] = "Bu Randevu tarihi doludur.";
            return response()->json($returnArray);
        }

        $create = Appointment::create($all);
        if($create)
        {
            $returnArray['status'] = true;
            $returnArray['message'] = "Randevunuz Başarı ile Alındı.";
        }
        else
        {
            $returnArray['message'] = "Veri Eklenemedi bizimle iletişime geçiniz";
        }
        return response()->json($returnArray);

    }
}
