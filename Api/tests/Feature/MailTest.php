<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MailTest extends TestCase
{
    use DatabaseTransactions;

    protected $userData;


    public function setUp():void
    {
        parent::setUp();
        $this->userData = factory(User::class)->make();

    }

    public function testGetMailLists()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testGetMailList()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testGetMailsRelatedToReciepent()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testCreateMailList()
    {

        $response = $this->get('/api/create-mail');

        $response->assertStatus(200);
    }

}
