<?php

namespace App\Http\Controllers;

use App\Http\Requests\MailRequest;
use App\Http\Services\FileUploadService;
use App\Http\Services\HttpResponseService;
use App\Models\Attachements;
use App\Models\Mails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as Authenticate;

class MailController extends Controller
{
    //
    protected $attach,$mails,$httpResponse,$fileService;

    public function __construct()
    {
        $this->middleware('auth:users');
        $this->mails = new Mails();
        $this->attach = new Attachements();
        $this->httpResponse = new HttpResponseService();
        $this->fileService = new FileUploadService();
    }

    public function createMail(MailRequest $request)
    {
      $request->validated();

        /**
        * check if all file extensions are correct and of appropiate size
         */
    $this->fileService->checkFiles($request);

      $postedBy = Authenticate::guard('users')->user()->id;

      $this->mails->createMails($request,$postedBy);

      $lastInserted = $this->mails->getLastPostedItemBySpecificUser($postedBy);

      $uploadFiles = $this->fileService->uploadFiles($request,$lastInserted->id);

      $checkIfAnyFileWasUploaded= count($uploadFiles);

      if($checkIfAnyFileWasUploaded > 0)
      {
          $this->attach->multipleInsertFileNames($uploadFiles);
      }

      $responseMessge = "email was sent successfully";

      return $this->httpResponse->is200Response($responseMessge);

    }


    public function getMailList()
    {
        $perPage = 10;

     $data = $this->mails->getMails($perPage);

     $message = "mail list";

     return $this->httpResponse->is200WithResponseData($message,$data);
    }

    public function getSingleMail($uuid)
    {
     $data = $this->mails->getMail($uuid);

     $responseMessage = "data";

     return $this->httpResponse->is200WithResponseData($responseMessage,$data);
    }

    public function getMailsRelatedToReciepients($reciepientEmail)
    {
        $perPage = 10;

     $data = $this->mails->getMailRelatedToReciepient($reciepientEmail,$perPage);

     $responseMessage = "data";

     return $this->httpResponse->is200WithResponseData($responseMessage,$data);

    }
}
