<?php

namespace App\Controllers;

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

      die('ok');
    }
}