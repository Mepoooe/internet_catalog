<?php

namespace App;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image ;
use Illuminate\Database\Eloquent\Model;

class goodsImage extends Model
{
    static function addImage ($file) 
    {
        $fileName = $file->getClientOriginalName();
        $fileName = uniqid().$fileName;
        $filePath = '/tmp/' .$fileName;
        if(is_file($filePath)){
            $filePath->destroy();
        }

        Image::make($file)
            ->resize(100, 100, function($constraint) {
                $constraint->aspectRatio();
            })
            ->save('./tmp/cut-' .$fileName);

        $file->move('tmp', $fileName);
        return $fileName;
    }

    public function delImage () 
    {

    }
}
