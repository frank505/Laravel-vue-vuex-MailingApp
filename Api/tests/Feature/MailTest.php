<?php

namespace Tests\Feature;

use App\Models\Attachements;
use App\Models\User;
use App\Models\Mails;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth as Authenticate;
use Tests\TestCase;


class MailTest extends TestCase
{
    use DatabaseTransactions;

    protected $userData,$mail,$attachement;


    public function setUp():void
    {
        parent::setUp();
        $this->userData = factory(User::class)->make();
        $this->mail = factory(Mails::class)->make();
        $this->attachement = factory(Attachements::class)->make();
    }

    public function createUser()
    {
        return  factory(User::class)->times(1)->create();
    }

    public function credentials()
    {
        return [
            "email"=>$this->userData->email,
            "password"=>"password"
        ];
    }


    public function testGetMailLists()
    {
        $this->createUser();
        $token = Authenticate::guard('users')->attempt($this->credentials());

        $headers = [
            "Authorization"=>'Bearer '.$token
        ];
        $response = $this->get('/api/get-mails',$headers);

        $response->
        assertStatus(200)
        ->assertJson([
            "success"=>true
        ]);
    }

    public function testGetSingleMail()
    {
       $dataSet = $this->setData();

       $headers = [
           "Authorization"=>'Bearer '.$dataSet['token'],
       ];

        $uuid = $dataSet['data']['uuid'];

        $response = $this->get('/api/get-mail/'.$uuid,$headers);

        $response->assertStatus(200)
        ->assertJson([
            'success'=>true
        ]);
    }


    public function setData()
    {
        $this->createUser();
        $token = Authenticate::guard('users')->attempt($this->credentials());

        $user = auth('users')->authenticate($token);

        $data = $this->dataCreateMail($user->id);

        return [
          "token"=>$token,
          "user"=>$user,
          "data"=>$data,
        ];
    }


    public function testCreateMail()
    {
        $this->createUser();
        $token = Authenticate::guard('users')->attempt($this->credentials());

        $user = auth('users')->authenticate($token);

        $data = $this->dataCreateMail($user->id);

        $headers = [
            'Authorization'=>'Bearer '.$token
        ];

        $response = $this->post('/api/create-mail',$data['data'],$headers);
        $response->
        assertStatus(200)
        ->assertJson([
            "success"=>true,
        ]);
    }


    public function dataCreateMail($postedBy)
    {
        $uuid = $this->mail->uuid;
        $data =  [
            'uuid' => $uuid,
            'posted_by_id' => $postedBy,
            'from'=>$this->mail->from,
            'to'=>$this->mail->to,
            'subject'=>$this->mail->subject,
            'text_content'=>$this->mail->text_content,
            'html_content'=>$this->mail->html_content,
            'status'=>'Posted'
        ];

        return [
          "uuid"=>$uuid,
          "data"=>$data,
          "reciepient"=>$this->mail->to
        ];
    }


    public function testCreateMailWithFiles()
    {
        $this->createUser();
        $token = Authenticate::guard('users')->attempt($this->credentials());

        $user = auth('users')->authenticate($token);

        $data = $this->dataCreateMail($user->id);

        $headers = [
            'Authorization'=>'Bearer '.$token
        ];


        $response = $this->post('/api/create-mail',$data['data'],$headers);

        $mails = new Mails();

        $lastInsertedByUserId = $mails->getLastPostedItemBySpecificUser($user->id);

        $this->uploadFile($lastInsertedByUserId);

        $response->
        assertStatus(200)
            ->assertJson([
                "success"=>true,
            ]);
    }


    public function uploadFile($mail_id)
    {
        Storage::fake('avatars');

        $file = UploadedFile::fake()->create('avatar.jpg',100);


        factory(Attachements::class)->create([
           'file_name'=>$file->getClientOriginalName(),
           'mail_id'=>$mail_id
        ]);

    }

    public function testGetMailsRelatedToReciepent()
    {

        $dataSet = $this->setData();

        $headers = [
            "Authorization"=>'Bearer '.$dataSet['token'],
        ];

        $reciepient = $dataSet['data']['reciepient'];

        $response = $this->get('/api/get-reciepients-mails/'.$reciepient,$headers);

        $response->assertStatus(200)
            ->assertJson([
                'success'=>true
            ]);
    }


    public function testFilterMails($filterData)
    {
        $this->createUser();
        $token = Authenticate::guard('users')->attempt($this->credentials());

        $user = auth('users')->authenticate($token);

        $data = $this->dataCreateMail($user->id);

        $headers = [
            'Authorization'=>'Bearer '.$token
        ];

        $this->post('/api/create-mail',$data['data'],$headers);

         $from = $data['data']['from'];
         $to = $data['data']['to'];
         $subject= $data['data']['subject'];

        $dataFilter = "?from=$from&to=$to&subject=$subject";

        $response = $this->get('/api/get-filter-mails'.$dataFilter, $headers);

        $response->assertStatus(200)
            ->assertJson([
                'success'=>true
            ]);

    }



}
