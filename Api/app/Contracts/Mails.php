<?php
namespace App\Contracts;

interface Mails
{
    /**
     * get mails based on the uuid
     * @param $uuid
     * @return mixed
     */
    public function getMails($uuid);

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
    public function getMailRelatedToReciepient($reciepientEmail);

}
