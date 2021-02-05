<?php


namespace App\Http\Services;


use Carbon\Carbon;

class FileUploadService
{
   protected $maxSize,$response,$attachedDir;

   public function __construct()
   {
       $this->maxSize = 2097152;
       $this->response = new HttpResponseService();
       $this->attachedDir = "./attachedTasks";
   }

    public function  checkFiles($request)
    {


     if($request->hasFile('attachment'))
     {
         $allowedfileExtension=['pdf','jpg','png','docx','jpeg'];

         foreach($request->file('attachment') as $file)
         {
             $filename = $file->getClientOriginalName();
             $extension = $file->getClientOriginalExtension();
             $getSize = $file->getSize();
             if($getSize > $this->maxSize)
             {
               return $this->response->is400Response(
                   "failed upload".$filename." size is larger than 2mb you can
                   upload to a server and share the link");
             }

             $check = in_array($extension, $allowedfileExtension);

              if($check==false)
              {
             return $this->response->is400Response($extension."is not an acceptable file type");
              }
         }
         return true;
     }

     /**
      * if there are no files return a success response
      */
     return true;

    }


    public function uploadFiles($request,$postId)
    {
        $arrayData = [];
        if($request->hasFile('attachment'))
        {
            $files = $request->file('attachment');

            foreach ($files as $file)
            {
                $file_extension = $file->getClientOriginalExtension();
                //return $file_extension;
                $file_name = uniqid()."_".time().date("Ymd")."_ATTACHED.".$file_extension; //change file name
                $file->move($this->attachedDir, $file_name); //more like the m
                $arrayData[] = array('mail_id'=>$postId,'file_name'=>$file_name,
                    "created_at"=>Carbon::now(), "updated_at"=>Carbon::now());
            }

        }
     return $arrayData;
    }


    }
