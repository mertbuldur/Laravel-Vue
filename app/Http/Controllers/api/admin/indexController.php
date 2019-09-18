<?php

namespace App\Http\Controllers\api\admin;

use App\Appointment;
use App\WorkingHours;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class indexController extends Controller
{
    public function getList()
    {
        $data = Appointment::orderBy('created_at','desc')->paginate(1);
        $data->getCollection()->transform(function ($value){
           $value['working'] = WorkingHours::getString($value['workingHour']);
           return $value;
        });
        return response()->json($data);
    }
}
