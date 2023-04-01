<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthExpirtController;
use App\Http\Controllers\CounselingController;
use App\Http\Controllers\AvailableTimeController;
use App\Http\Controllers\InsertInformationController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


////////////////////////////////user//////////////////////////////////////
Route::group(['prefix' => '/'], function(){  
Route::post('user-rgister',[AuthController::class, 'userRegister']);
Route::post('user-login',[AuthController::class, 'userLogin']);
//حجز موعد
Route::post('add',[AvailableTimeController::class,'book']);
//عرض الاستشارات الاساسية
Route::get('counselings',[CounselingController::class,'counselings']);
//عرض معلومات خبير
Route::get('information/{id}',[InsertInformationController::class,'getinfo']);
//عرض الاستشارات والخبراء الخاصه بها
Route::get('show',[CounselingController::class,'show']);
//بحث حسب اسم الخبير
Route::get('searchE',[CounselingController::class,'searchByExpirtName']);
//بحث حسب اسم الاستشارة
Route::get('searchC',[CounselingController::class,'searchByCounselingName']);
//عرض استشارات خبير حسب الرقم ID
Route::get('couns-expirt/{id}',[CounselingController::class,'getAllCounselingsByExpirt']);
//عرض خبراء الاستشارة حسب الرقمID
Route::get('expirts-couns/{id}',[CounselingController::class,'getAllExpirtsByCounseling']);
//عرض كل الخبراء والاستشارات
Route::get('expirts-counselings',[CounselingController::class,'AllExpirtsCounseling']);
Route::group( ['prefix' => 'user','middleware' => ['auth:user-api','scopes:user'] ],function(){
    Route::post('logout',[AuthController::class, 'userLogout']);
});
});
////////////////////////////////////expirt///////////////////////////////////////
Route::group(['prefix' => '/'], function(){  
Route::post('expirt-register',[AuthExpirtController::class, 'expirtRegister']);
Route::post('expirt-login',[AuthExpirtController::class, 'expirtLogin']);
Route::post('insert-info',[InsertInformationController::class,'insert']);
//ادخال استشارات الى الخبير
Route::post('savecounselingstoexpirt',[CounselingController::class,'saveCounselingsToExpirt']);
//ادخال الاوقات المتاحة
Route::post('insert_times',[InsertInformationController::class,'insert_availabletime']);
//عرض المواعيد المحجوزة
Route::get('expirt-available/{id}',[InsertInformationController::class,'getNotAvailableTime']);
Route::group( ['prefix' => 'expirt','middleware' => ['auth:expirt-api','scopes:expirt'] ],function(){
    Route::post('logout',[AuthExpirtController::class, 'expirtLogout']);

});

});
