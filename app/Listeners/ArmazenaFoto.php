<?php


namespace App\Listeners;

use App\Events\FotoCreating;
use Illuminate\Support\Facades\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class ArmazenaFoto
{
    public function handle(FotoCreating $event)
    {
        $foto = Request::hasFile('foto') ? Request::file('foto') : $event->model->fotos;
        $model = $event->model;

        if (!is_null($foto)) {
            // Get file name and creating paths
            $nome = $foto->getClientOriginalName();
            $originalName = 'original-' . $nome;
            $thumbName = 'thumb-' . $nome;

            $path = 'app/public/Fotos/' . $model->produto->nome;
            //---------------------------------


            // Resizing image
            $image_resize = Image::make($foto->getRealPath());
            $image_resize->resize(450, 450, function ($constraint) {$constraint->aspectRatio();});
            //---------------


            // Saving in storage
            Storage::put($path.'/'.$originalName, file_get_contents($foto), 'public');
            Storage::put($path.'/'.$thumbName, $image_resize->encode(), 'public');
            //------------------


            // Saving in database
            $model->foto = $thumbName;
            $model->save();
            //-------------------
        }
    }
}