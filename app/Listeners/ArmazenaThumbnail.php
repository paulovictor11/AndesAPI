<?php

namespace App\Listeners;

use App\Events\ThumbnailCreating;
use Illuminate\Support\Facades\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class ArmazenaThumbnail
{
    public function handle(ThumbnailCreating $event)
    {
        $thumbnail = Request::hasFile('thumbnail') ? Request::file('thumbnail') : $event->model->thumbnail;
        $model = $event->model;

        if (!is_null($thumbnail)) {
            // Get file name and creating paths
            $nome = $thumbnail->getClientOriginalName();
            $originalName = 'original-' . $nome;
            $thumbName = 'thumb-' . $nome;

            $path = 'app/public/Produtos/' . $model->nome;
            //----------------------------------


            // Resizing image
            $image_resize = Image::make($thumbnail->getRealPath());
            $image_resize->resize(450, 450, function ($constraint) {$constraint->aspectRatio();});
            //---------------


            // Saving in storage
            Storage::put($path.'/'.$originalName, file_get_contents($thumbnail), 'public');
            Storage::put($path.'/'.$thumbName, $image_resize->encode(), 'public');
            //------------------


            // Save thumb image name in database
            $model->thumbnail = $thumbName;
            $model->save();
        }
    }
}