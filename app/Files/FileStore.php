<?php

namespace App\Files;

use Slim\Http\UploadedFile;

class FileStore
{
  public function store(UploadedFile $file)
  {
    $file->moveTo('abc.jpg');

    return $this;
  }
}
