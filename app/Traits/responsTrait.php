<?php


namespace App\Traits;


trait responsTrait{


    public function returnSuccessMsg( $smg = "", $errorNumber = '1'){

        return[
            'status' => true,
            'errorNumber' => $errorNumber,
            'smg' => $smg,
        ];

    }

    public function returnData($msg = "", $key, $value){

        return response([
            'status'=>true,
            'errorNumber' => '0',
            'msg' => $msg,
            $key => $value,
        ]);

    }

    public function returnError( $errorNumber, $msg){

        return response([

            'errorNumber' => $errorNumber,
            'status' => false,
            'msg' => $msg,

        ]);

    }



}
