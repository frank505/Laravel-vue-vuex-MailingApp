<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\Mails as MailsContract;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;


class Mails extends Model implements MailsContract
{
    use HasFactory;

    protected $table = "mails";

    protected $storage;

    protected $fillable = ["uuid","posted_by_id","from","to","subject",
        "html_content","status","text_content"];


    public function __construct()
    {

    }

    public function createMails($request,$PostedBy)
    {
        Cache::forget('posts_content');
        Cache::forget('reciepient_content.'.$request->to);
        Cache::forget('posted_by.'.$PostedBy);
        $uuid = Str::orderedUuid()->toString();
        return  $this->create([
              "uuid"=>$uuid,
              'posted_by_id'=>$PostedBy,
              "from"=>$request->from,
              "to"=>$request->to,
              "subject"=>$request->subject,
              "text_content"=>$request->text_content,
              "html_content"=>$request->html_content,
              "status"=>"Posted"
          ]);


    }

    /**
     * @inheritDoc
     */
    public function getMails($perPage)
    {
        // TODO: Implement getMails() method.

        Cache::remember('post_content',33600,function($perPage){
            return $this->with('attachements')->paginate($perPage);
        });


    }

    public function attachements()
    {
        return $this->hasMany('App\Models\Attachements','mail_id','id');
    }

    /**
     * @inheritDoc
     */
    public function getMail($uuid)
    {
        // TODO: Implement getMail() method.

        Cache::rememberForever('posts.'.$uuid,function ($uuid){

            return  $this->where(['uuid'=>$uuid])->with('attachements')->first();
        });

    }

    /**
     * @inheritDoc
     */
    public function getMailRelatedToReciepient($reciepientEmail,$perPage)
    {
        // TODO: Implement getMailRelatedToReciepient() method.
       Cache::remember('reciepient_content.'.$reciepientEmail,33600, function($perPage,$reciepientEmail)
       {
           return  $this->where(["to"=>$reciepientEmail])->with('attachements')->paginate($perPage);
       });

    }

    public function getLastPostedItemBySpecificUser($PostedBy)
    {
        // TODO: Implement getLastPostedItemBySpecificUser() method.
        Cache::remember('posted_by.'.$PostedBy,33600,function($perPage,$PostedBy)
        {
            return $this->where(["posted_by_id"=>$PostedBy])->with('attachements')->latest()->first();
        });

    }

}
