<?php


namespace App\Http\Services;


class FileUploadService
{
   protected $maxSize,$response,$attachedDir;

   public function __construct()
   {
       $this->maxSize = 1024;
       $this->response = new HttpResponseService();
       $this->attachedDir = "./attachedTasks";
   }

    public function  checkFiles($request)
    {
     if($request->hasFiles('attached'))
     {
         $allowedfileExtension=['pdf','jpg','png','docx'];

         $files = $request->file('attached');

         foreach($files as $file)
         {
             $filename = $file->getClientOriginalName();
             $extension = $file->getClientOriginalExtension();
             $getSize = $file->getSize();
             if($getSize > $this->maxSize)
             {
               return $this->response->is400Response(
                   "failed upload".$filename." size is larger than 1mb");
             }

             $check = in_array($extension, $allowedfileExtension);

              if($check==false)
              {
             return $this->response->is400Response("invalid acceptable file type");

              }
         }
         return $this->response->is200Response($request);
     }

    }


    public function uploadFiles($request,$postId)
    {

        if($request->hasFiles('attached'))
        {
            $files = $request->file('attached');
            $arrayData = [];
            foreach ($files as $file)
            {
                $file_extension = $file->getClientOriginalExtension();
                //return $file_extension;
                $file_name = uniqid()."_".time().date("Ymd")."_ATTACHED.".$file_extension; //change file name
                $file->move($this->attachedDir, $file_name); //more like the m
                $arrayData[] = array('my_id'=>$postId,'file_name'=>$file_name);
            }
            return $arrayData;
        }

    }


    }
