<?php
namespace App\Contracts;

interface Mails
{
    /**
     * @param $perPage number of items to display perpage for pagination
     * get mails based on the uuid
     * @return mixed
     */
    public function getMails($perPage);

    /**
     * get a single mail based on the uuid
     * @param $uuid
     * @return mixed
     */
    public function getMail($uuid);

    /***
     * get mails related to a specific reciepent
     * @param $reciepientEmail
     * @return mixed
     */
    public function getMailRelatedToReciepient($reciepientEmail,$perPage);
    /**
    * create mails
     */
    public function createMails($request,$PostedBy);

    /**
     * @return mixed
     * this is the relationship between mails and attachemnts
     */
    public function attachements();
    /**
    * get last posted item by specific user
     */
    public function getLastPostedItemBySpecificUser($PostedBy);

}
