<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
class RegistrationlistController extends Controller
{
    //this is to show the registrationlist on the dashbord
    public function ShowList(Request $request){
        $currentday = config('date.CURRENT_DAY');


        $isregistration = 1;
        $id = $request->user()->id;
        $db = DB::table('registration');
        $test = $db->where('user_id',[$id])->get();
        if(empty($test[0])){
            $isregistration = 0;
        }
        else{
            foreach ($test as $k1=>$v1){
                if($v1->day < $currentday)
                    $test[$k1] ->status = 1;
                $regdate = Carbon::now()->subDay($currentday-$v1->day)->toDateString();
                $test[$k1]->day = $regdate;
            }
        }
        return view('dashboard',compact('test','isregistration'));
    }
}
