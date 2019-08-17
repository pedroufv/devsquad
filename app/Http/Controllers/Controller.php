<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

/**
 * @OA\Server(url="http://devsquad.local:8080/api/v1"),
 * @OA\Info(title="DevSquad", version="0.0.1")
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function spa()
    {
        return view('app');
    }

    public function landing()
    {
        return view('landing');
    }

    public function file($filename)
    {
        $path = storage_path() . '/app/public/files/'.$filename;

        if(!File::exists($path)) abort(404);

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }
}

/**
 *  @OA\SecurityScheme(
 *      type="http",
 *      scheme="bearer",
 *      securityScheme="bearerAuth",
 *  )
 */
