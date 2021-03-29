<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\registerReq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Traits\responsTrait;
use Illuminate\Support\Facades\DB;

class loginCon extends Controller
{
    use responsTrait;

    /*
    public function register(Request $request){
        $request->validate([
            'name'=> 'required',
            'email'=> 'required|email',
            'password' => 'required|confirmed'
        ]);

        $user = user::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password' => bcrypt($request->password),
        ]);
        $user->save();

        return $user;

    }


    ////////////////////////////


    public function login(Request $request){

        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(!Auth::attempt($validate)){
            return response()->json(['message' => 'invalid validateeeeeeeeeeeeee']);
        }
        $accessToken = Auth::user()->createToken('authToken')->accessToken; //

        return response()->json(['user'=>Auth::user(),'access_token'=>$accessToken]);
    }

    */



    public function register(registerReq $request){

        try {
            DB::beginTransaction();
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password)
                ]);
            DB::commit();

            return $this->returnData('done','user',$user);

        }catch (\Exception $exception){

            DB::rollBack();
            return $this->returnError('1','حدث خطا ما');
        }
    }

    public function login(Request $request){
        try {

            if (Auth::attempt($request->only('email', 'password'))) {

                $user = Auth::user();                                                    // Data user
                $token = $user->createToken('token')->accessToken;                      //create token
                $user['token'] = $token;                                               // add token in user

                return $this->returnData('done','user',$user);                //return data

            }
        }catch (\Exception $exception){

            return $this->returnError('0','حدث خطأ ما');              //return message error
        }

        return $this->returnError('0','invalid userName/password');  //return message if unauthenticated
    }

    public function users(){

        $user = Auth::user();

        return $this->returnData('done','user',$user);

    }


}
