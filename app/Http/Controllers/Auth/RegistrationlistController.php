<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;
class RegistrationlistController extends Controller
{
    //this is to show the registrationlist on the dashbord
    public function ShowList(Request $request){
        $currentday = config('date.CURRENT_DAY');
        $starttime = Carbon::now()->subDay($currentday)->toDateString();

        $isregistration = 1;
//        $id = $request->user()->id;
        $id = 1;
        $db = DB::table('registration');

        $test = $db->where('user_id',[$id])->get();
        foreach ($test as &$value)
            if(!empty($value->user_id))
                $isregistration = 0;
            else
                $value->auth_code = $starttime;
        dd($test);
//        foreach ($test as $key => $value)
//            echo "预约日期是{$value->day}</br>";

        return view('dashboard',compact('test','isregistration'));
    }
}
