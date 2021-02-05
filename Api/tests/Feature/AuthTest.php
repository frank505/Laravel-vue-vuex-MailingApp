<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\JWT;
use Illuminate\Support\Facades\Auth as Authenticate;

 class AuthTest extends TestCase
{

    use DatabaseTransactions;

    protected $userData;


    public function setUp():void
    {
        parent::setUp();
        $this->userData = factory(User::class)->make();

    }

  public function createUser()
  {
      return  factory(User::class)->times(1)->create();
  }

    public function testLogin()
    {

         $this->createUser();

         $credentials = [
           "email"=>$this->userData->email,
           "password"=> 'password'
         ];
        $response = $this->postJson('/api/login', $credentials);

      $response->
          assertStatus(200)
       ->assertJson([
           "success"=>true,
            "message"=> 'login was successful'
        ]);
    }


    public function testRegister()
    {

        $credentials = [
            "name"=>$this->userData->name,
            "email"=>$this->userData->email,
            "password"=> 'password'
        ];
        $response = $this->postJson('/api/register',$credentials);

        $response->assertStatus(200)
            ->assertJson(
                ["success"=>true,
                    "message"=>"registration was successful"
                    ]
            );
    }





}
