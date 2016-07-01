<?php

namespace App\Http\Controllers;

use App\Electrics;
use Illuminate\Http\Request;

use App\Http\Requests;
use Mockery\CountValidator\Exception;
use Intervention\Image\Facades\Image ;
use Illuminate\Support\Facades\File;

class ElectricsController extends Controller
{
    public function index()
    {
        $data['electrics'] = Electrics::all()->toArray();
        return view('admin.electrics.index', $data);
    }

    /*
     * Добавление записи в DB
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'name' => 'required',
            'producer' => 'required',
            'price' => 'required|numeric',
            'status' => 'required',
            'description' => 'required',
            'image' => 'required|image'
        ]);

        try {
            //добавление картинки
            $file = $request->file('image');
            //эта функция обрезает фото и сохраняет обрезанный вариант с оригиналом, возвращает имя файл
            $file = $this->addImg($file);

            $electrics = new Electrics();
            $electrics->title = $request->input('title');
            $electrics->name = $request->input('name');
            $electrics->producer = $request->input('producer');
            $electrics->price = $request->input('price');
            $electrics->status = $request->input('status');
            $electrics->description = $request->input('description');
            $electrics->img = $file->getClientOriginalName();
            $electrics->save();
        } catch(Exception $e) {
            Log::error('Ошибка записи');
            return redirect('/admin');
        }

        return redirect('/admin/electrics');
    }

    /*
     * Удаление записи с DB
     */
    public function destroy($id = null)
    {
        try {
            $el = Electrics::where('id', '=', $id)->find($id);
            $imgName = $el->img;

            $filePath = "./tmp/" .$imgName;

            if(is_file($filePath)){
                File::delete("./tmp/cut-" .$imgName);
                File::delete("./tmp/" .$imgName);
            }

            Electrics::destroy($id);

            return redirect('/admin/electrics');
        } catch(Exception $e) {
            Log::error('Ошибка удаления');
            return redirect()->back();
        }
    }


    //  функция обрезает фото и сохраняет обрезанный вариант с оригиналом, возвращает имя файл
    public function addImg ($file) {
        $fileName = $file->getClientOriginalName();
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
        return $file;
    }
}
