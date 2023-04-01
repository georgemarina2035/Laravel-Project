<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Expirt;
use App\Models\Information;
use Illuminate\Http\Request;

class ExpirtController extends Controller
{

    public function store(Request $request)
    {
        $this->validate($request,[
        'name'=>'required',
        'image'=>'nullable|image',
        'address'=>'required',
        'email'=>'required|email',
        'mobile'=>'required',
        'experience'=>'required',
        'available_times'=>'required',
        ]);
        $image=$request->image;
        $newimage=time().$image.getClientOriginalName();
        $image->move('public/images/expirts'.$newimage);
        $info=Information::create([
            'name'=>$request->name,
            'image'=>'public/images/expirts/'.$nawimage,
            'address'=>$request->address,
            'email'=>$request->email,
            'mobile'=>$request->mobile,
            'experience'=>$request->experience,
            'available_times'=>$request->available_times,
            'exp_id'=>Auth::id()
        ]);
        return response()->json([$info,'Information store successfully']);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
