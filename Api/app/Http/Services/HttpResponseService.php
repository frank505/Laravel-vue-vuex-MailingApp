<?php
namespace App\Http\Services;

use Illuminate\Http\Exceptions\HttpResponseException;


class HttpResponseService
{


    public function is200Response($responseMessage)
    {
        throw new HttpResponseException(response()->json(
            [
                "success"=>true,
                "message"=>$responseMessage
            ], 200));
    }

    public function is200WithResponseData($responseMessage,$data)
    {
        throw new HttpResponseException(response()->json(
            [
                "success"=>true,
                "message"=>$responseMessage,
                "data"=>$data
            ], 200));
    }

    public function is422Response($responseMessage)
    {
        throw new HttpResponseException(response()->json(
            [
                "success"=>false,
                "message"=>$responseMessage
            ], 422));
    }


    public function is500Response($responseMessage)
    {
        throw new HttpResponseException(response()->json(
            [
                "success"=>false,
                "message"=>$responseMessage
            ], 500));
    }


    public function is400Response($responseMessage)
    {
        throw new HttpResponseException(response()->json(
            [
                "success"=>false,
                "message"=>$responseMessage
            ], 400));
    }

    public function is400ResponseWithData($responseMessge,$data)
    {
        throw new HttpResponseException(response()->json([
            "success"=>false,
            "message"=>$responseMessge,
            "data"=>$data
        ]));
    }




}
