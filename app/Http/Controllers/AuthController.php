<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Sapport\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function userRegister(Request $request):JsonResponse
    {
        $request->validate([
            'name'=>['required','max:55'],
            'email'=>['email','required','unique:users'],
            'password'=>[
                'required',
                'confirmed',
                Password::min(8)
                ->letters()
                ->numbers()
                ->symbols()
            ],
            'account'=>['nullable']
        ]);
        $input=$request->all();
        $input['password']=bcrypt($input['password']);
        $user=User::create($input);
        $accessToken=$user->createToken('user',['user'])->accessToken;
        return response()->json([
            'user'=>$user,
            'access_token'=>$accessToken
        ]);
    }
    public function userLogin(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        $credentials=request(['email','password']);
        if(auth()->guard('user')->attempt($request->only('email','password')))
        {
           // config(['auth.guards.api.provider'=>'user']);
            $user=User::query()->select('users.*')->find(auth()->guard('user')->user()['id']);
            $success=$user;
            $success['token']=$user->createToken('MyApp',['user'])->accessToken;
            return response()->json($success);
        }
        else
        {
            return response()->json(['error'=>['Unauthorised']],401);
        }
    }
    public function userLogout(): JsonResponse
    {
        Auth::guard('user-api')->user()->token()->revoke();
        return response()->json(['success'=>'logged out successfuly']);
    }
    public function pageuser($id)
    {
        return $user=User::select('name','email','account')->find($id);
    }
    }

