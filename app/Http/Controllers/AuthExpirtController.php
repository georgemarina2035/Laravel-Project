<?php

namespace App\Http\Controllers;

use App\Models\Expirt;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Sapport\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AuthExpirtController extends Controller
{
    public function expirtRegister(Request $request):JsonResponse
    {
        $request->validate([
            'name'=>['required','max:55'],
            'email'=>['email','required','unique:expirts'],
            'password'=>[
                'required',
                'confirmed',
                Password::min(8)
                ->letters()
                ->numbers()
                ->symbols()
            ],
          //  'portfolio'=>['nullable'],
        ]);
        $input=$request->all();
        $input['password']=bcrypt($input['password']);
        $expirt=Expirt::query()->create($input);
        $accessToken=$expirt->createToken('expirt',['expirt'])->accessToken;
            return response()->json([
            'expirt'=>$expirt,
            'access_token'=>$accessToken
        ]);
    }
    public function expirtLogin(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        $credentials=request(['email','password']);
        if(auth()->guard('expirt')->attempt($request->only('email','password')))
        {
            config(['auth.guards.api.provider'=>'expirt']);
            $expirt=Expirt::query()->select('expirts.*')->find(auth()->guard('expirt')->user()['id']);
            $success=$expirt;
            $success['token']=$expirt->createToken('MyApp',['expirt'])->accessToken;
            return response()->json($success);
        }
        else
        {
            return response()->json(['error'=>['Unauthorised']],401);
        }
    }
    public function expirtLogout(): JsonResponse
    {
        Auth::guard('expirt-api')->user()->token()->revoke();
        return response()->json(['success'=>'logged out successfuly']);
    }
}
