<?php
namespace App\Contracts;

interface Attachements
{
/***
* insert a single or multiple files
*/
 public function multipleInsertFileNames($uploadFiles);

    /**
     * mail relationship with attachements
     * @return mixed
     */
 public function mail();

}
