<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLogin()
    {
        $response = $this->post('/api/login');

        $response->assertStatus(200);
    }

    //    public function actingAs(JWTSubject $user, $driver = null)
//    {
//
//        $token = new JWT;
//        $token = $token->fromUser($user);
//        $this->withHeader('Authorization', "Bearer {$token}");
//        parent::actingAs($user);
//
//        return $this;
//    }
}
