<?php

namespace App\Http\Controllers;

use App\Models\Expirt;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function relation(){

        $expirt=Expirt::find(2);
      return  $expirt->information;
        //return response()->json($expirt);
    }

    public function getExpirtCounselings(){

      $expirt=Expirt::find(3);
      $expirt->counselings;
    }

}
