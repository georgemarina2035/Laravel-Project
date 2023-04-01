<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Expirt;
use App\Models\Information;
use Illuminate\Http\Request;
use App\Models\AvailableTime;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InsertInformationController extends Controller
{
    public function insert(Request $request)
{
    $this->validate($request,[
        'name'=>'required',
        'image'=>'nullable|image',
        'address'=>'required',
        'email'=>'required|email',
        'mobile'=>'required',
        'experience'=>'required',
       'expirt_id'=>'required'
    ]);
        $image=$request->file('image');
        $newimage=time().$image->getClientOriginalName();
        $image->move('public/images/expirts'.$newimage);
        $info=Information::create([
            'name'=>$request->name,
            'image'=>'public/images/expirts/'.$newimage,
            'address'=>$request->address,
            'email'=>$request->email,
            'mobile'=>$request->mobile,
            'experience'=>$request->experience,
            'expirt_id'=>$request->expirt_id,
        ]);
        return response()->json([$info,'Information store successfully']);
    }
        public function insert_availabletime(Request $request)
        {
            $from = $request->from;
            $to = $request->to;
          while ($from < $to) {
            $input['day']= $request->day;
            $input['from']= $from;
            $input['to']= $from +1;
            $input['available']=0;
            $availabletime=AvailableTime::create($input);
            $from = $from+1;
            $availabletime->save();
            $expirt=Expirt::find($request->expirt_id);
            $availabletime->expirts()->attach($expirt);

          }  
          
        return response()->json([$availabletime,'success']);
        }
        public function getinfo($id)
        {
            $expirt=Expirt::find($id);
            $info=$expirt->informations;
            $time=$expirt->availabletimes;
            $counse=$expirt->counselings;
            return response()->json(['information'=>$info,'availabletime'=>$time,'counseling'=>$counse]);
        }
        public function getNotAvailableTime($id)
    {
        return $expirt=Expirt::with(['availabletimes'=>function($q){
            if('available'==1){
            $q->select('day','from','to','available');
            }
        }])->find($id);

        
        
    }
        
        
    }