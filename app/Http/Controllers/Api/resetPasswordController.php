<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\reserRequest;
use App\Http\Requests\resetRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\responsTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class resetPasswordController extends Controller
{
    use responsTrait;



    public function reset(resetRequest $request){

        $token = $request->token;

        if(!$passwordReset = DB::table('password_resets')->where('token',$token)->first()){
            return $this->returnError('1','invalid token');
        }

        if(!$user = User::where('email',$passwordReset->email)->first()){
            return $this->returnError('1','user dosen\'t exist');
        }

        $user->password = Hash::make($request->password);
        $user->save();
        return $this->returnSuccessMsg('done');

    }

}
