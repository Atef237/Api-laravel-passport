<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\forgotReq;
use App\Http\Requests\resetRequest;
use App\Mail\forgot;
use App\User;
use Illuminate\Http\Request;
use App\Traits\responsTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use mysql_xdevapi\Exception;
use Illuminate\Support\Str;

class forgotCon extends Controller
{
    use responsTrait;
    public function forgot(forgotReq $request){
        $email = $request->email;

        if(User::where('email',$email)->doesntExist()){
            return $this->returnError('1','user dosen\'t exists');
        }

        $token = Str::random(10);

        try {
                DB::table('password_resets')->insert([
                    'email' => $email,
                    'token' => $token,
                ]);


                    Mail::send('Mails.forgot',['token'=>$token], function (Message $message) use($email) {
                        $message->to($email);
                        $message->subiect('reset your password');
                    });


            //Mail::to($request->user())->send(new forgot($token));


                return $this->returnSuccessMsg('check your email');
        }catch (Exception $exception){

            return $this->returnError('1','Something went wrong');
        }
    }


}
