<?php

namespace App\Http\Controllers;

use App\Models\Expirt;
use App\Models\Counseling;
use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use App\Models\ExpirtsCounselings;

class CounselingController extends Controller
{
    public function counselings()
    {
        $couns=[
            ["counseling"=>'Psychological'],
            ["counseling"=>'medical'],
            ["counseling"=>'Vocational'],
            ["counseling"=>'family'],
            ["counseling"=>'Business']
        ];
    Counseling::insert($couns);
    return $couns;
    }
    ///////////////////////////////////////////عرض الاستشارات حسب الخبير///////////////////////////////
    public function getAllCounselingsByExpirt($id)
    {
        return $expirt=Expirt::with(['counselings'=>function($q){
            $q->select('counseling');
        }])->find($id);
        
        //$counselings=$expirt->counselings;
        //return $counselings;
    }
    //////////////////////////////////بحث حسب اسم خبير///////////////////////////////////
    public function searchByExpirtName(Request $request ){
          $name=$request->name;
        return $expirt=Expirt::with(['counselings'=>function($q){
            $q->select('counseling');
        }])->where('name','LIKE','%'.$name.'%')->get();
    }
    ////////////////////////////////////////////بحث حسب اسم الاستشاره/////////////////////////////
    public function searchByCounselingName(Request $request ){
        $name=$request->name;
        return $counseling=Counseling::with(['expirts'=>function($q){
            $q->select('name');
        }])->where('counseling','LIKE','%'.$name.'%')->get();
  }
    /////////////////////////////////////////////عرض الخبراء حسب الاستشارة////////////////////////////
    public function getAllExpirtsByCounseling($id)
    {
        return $counselings=Counseling::with(['expirts'=>function($q){
            $q->select('name');
        }])->find($id);
       // $expirts=$counselings->expirts;
       // return $expirts;
    }
    //////////////////////////////////////////////////////////////////////////////////
    
public function show(){
    return $counseling = Counseling::with('expirts')->get();
}
///////////////////////////////////////كل الخبراء والاستشارات///////////////////////
    public function AllExpirtsCounseling()
    {
        $all=[
         $expirt=Information::select('id','name','image')->get(),
         $counseling=Counseling::select('id','counseling')->get()
        ];
         return $all;
    }
    public function saveCounselingsToExpirt(Request $request)
    { 
        //اضافة خبرة جديدة
        $counseling=Counseling::create($request->all(),[
            'counseling'=>$request->counseling
        ]);
        $counseling->save();
        $expirt=Expirt::find($request->expirt_id);
        $counseling->expirts()->attach($expirt);
        return 'success';
}



}
