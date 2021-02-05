<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachements extends Model
{
    use HasFactory;

    protected $table = "attachements";
    protected $fillable = ["file_name","mail_id"];



}
