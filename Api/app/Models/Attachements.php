<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\Attachements as AttachementsContract;

class Attachements extends Model implements  AttachementsContract
{
    use HasFactory;

    protected $table = "attachements";
    protected $fillable = ["file_name","mail_id"];

    public function mail()
    {
        return $this->belongsTo('App\Models\Mail','mail_id','id');
    }

    public function multipleInsertFileNames($uploadFiles)
    {
        return $this->insert($uploadFiles);
    }

}
