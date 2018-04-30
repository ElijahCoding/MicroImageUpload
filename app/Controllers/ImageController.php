<?php

namespace App\Controllers;

use Exception;
use App\Models\Image;
use App\Files\FileStore;
use App\Controllers\Controller;
use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};

class ImageController extends Controller
{
    public function store(Request $request, Response $response, $args)
    {
      if (!$upload = $request->getUploadedFiles()['file'] ?? null) {
        return $response->withStatus(422);
      }

      try {
        $this->c->image->make($upload->file);
      } catch (Exception $e) {
        return $response->withStatus(422);
      }


      $store = (new FileStore())->store($upload);

      return $response->withJson([
        'data' => [
          'uuid' => $store->getStored()->uuid
        ]
      ]);
    }

    public function show(Request $request, Response $response, $args)
    {
      extract($args);

      try {
        $image = Image::where('uuid', $uuid)->firstOrFail();

      } catch (Exception $e) {
        return $response->withStatus(404);
      }

      $response->getBody()->write(
        $this->c->image->make(uploads_path($image->uuid))->encode('png')
      );

      return $response->withHeader('Content-Type', 'image/png');
    }
}
