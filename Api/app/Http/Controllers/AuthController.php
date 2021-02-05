<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Services\HttpResponseService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as Authenticate;


class AuthController extends Controller
{
    protected $httpResponse,$user;

    public function __construct()
    {
      $this->httpResponse = new HttpResponseService();
      $this->user = new User();
    }

    //
    public function login(LoginRequest $request)
    {
        $request->validated();
        $data = ["email"=>$request->email,"password"=>$request->password];

        $credentials = ["email"=>$request->email,"password"=>$request->password];

        if(!$tokenCred=Authenticate::guard('users')->attempt($credentials))
        {
            $responseMessage = "invalid username or password";

            return $this->httpResponse->is400Response($responseMessage);
        }
         $responseMessage = "login was successful";

        $data = ["token"=>$tokenCred];



    return $this->httpResponse->is200WithResponseData($responseMessage,$data);
    }


    public function register(RegisterRequest $request)
    {
        $request->validated();

        $this->user->createUser($request);

        $responseMessage = "registration was successful";

      return $this->httpResponse->is200Response($responseMessage);
    }

}
