<?php

namespace App\Http\Controllers;

use App\Http\Services\HttpResponseService;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    protected $httpResponse;

    public function __construct()
    {
      $this->httpResponse = new HttpResponseService();
    }

    //
    public function login()
    {
    $message = "success";
    return $this->httpResponse->is200Response($message);
    }


    public function register()
    {
      $message = "success";
      return $this->httpResponse->is200Response($message);
    }
}
