<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\Mails as MailsContract;

class Mails extends Model implements MailsContract
{
    use HasFactory;

    protected $table = "mails";

    protected $fillable = ["uuid","posted_by_id","from","to","subject","html_content","status"];


    public function createMails($request,$PostedBy)
    {
        $uuid = '';
        return  $this->create([
              "uuid"=>$uuid,
              'posted_by_id'=>$PostedBy,
              "from"=>$request->from,
              "to"=>$request->to,
              "subject"=>$request->subject,
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

        return $this->with('attachements')->paginate($perPage);
    }

    public function attachements()
    {
        return $this->hasMany('App\Models\Attachements','id','mail_id');
    }

    /**
     * @inheritDoc
     */
    public function getMail($uuid)
    {
        // TODO: Implement getMail() method.
      return  $this->where(['uuid'=>$uuid])->with('attachements')->first();
    }

    /**
     * @inheritDoc
     */
    public function getMailRelatedToReciepient($reciepientEmail,$perPage)
    {
        // TODO: Implement getMailRelatedToReciepient() method.

      return  $this->where(["to"=>$reciepientEmail])->with('attachements')->paginate($perPage);
    }

    public function getLastPostedItemBySpecificUser($PostedBy)
    {
        // TODO: Implement getLastPostedItemBySpecificUser() method.
        return $this->where(["posted_by"=>$PostedBy])->with('attachements')->latest()->first();
    }

}
