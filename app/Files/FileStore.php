<?php

namespace App\Files;

use Exception;
use App\Models\Image;
use Slim\Http\UploadedFile;

class FileStore
{
  protected $stored = null;

  public function getStored()
  {
    return $this->stored;
  }

  public function store(UploadedFile $file)
  {
    try {
      $model = $this->createModel($file);

      $file->moveTo(uploads_path($model->uuid));
    } catch (Exception $e) {
      dump($e);
    }

    return $this;
  }

  protected function createModel(UploadedFile $file)
  {
    return $this->stored = Image::create([
      'uuid' => 'ea20bc2f-c652-4aeb-a820-eab87c885043'
    ]);
  }
}
