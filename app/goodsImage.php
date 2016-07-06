<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class goodsImage extends Model
{
    public function addImage () 
    {

    }

    public function delImage ($Model, $id)
    {
        $el = $Model::where('id', $id)->find($id);
        $imgName = $el->img;

        $filePath = "./tmp/" .$imgName;

        if(is_file($filePath)){
            File::delete("./tmp/cut-" .$imgName);
            File::delete("./tmp/" .$imgName);
        }

        $Model::destroy($id);
    }
}
