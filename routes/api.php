<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('image', function () {
    logger(\request()->all());

    $targetDir = storage_path('app/public/');

    //if(\request()->hasFile("image")) {
    if (isset($_FILES['image'])) {
        return fileUpload($_FILES['image'], $targetDir);
    }

    if (isset($_REQUEST['image'])) {
        return base64Upload($_REQUEST['image'], $targetDir);
    }

    return "Image must is  file format or base64 format";
});

function base64Upload($image, $targetDir)
{
    $images = explode(';base64,', $image);

    if (count($images) === 2) {
        $image = array_pop($images);
    }

    $imgData = base64_decode($image);

    $f = finfo_open();
    $mimeType = finfo_buffer($f, $imgData, FILEINFO_MIME_TYPE);
    $typeFile = explode('/', $mimeType);
    $targetFile = generateFileName($typeFile[1]);

    $path = $targetDir . $targetFile;
//    \Illuminate\Support\Facades\Storage::put($targetFile, $imgData);
    file_put_contents($path, $imgData);

    return $path;
}

function fileUpload($file, $targetDir)
{
    $tail = strtolower(pathinfo($file["name"],PATHINFO_EXTENSION));
    $targetFile = $targetDir . generateFileName($tail);
    move_uploaded_file($file["tmp_name"], $targetFile);

    return $targetFile;
}

function generateFileName($tail)
{
    return uniqid() . '-' . time() . '.' . $tail;
}
