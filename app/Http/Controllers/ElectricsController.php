<?php

namespace App\Http\Controllers;

use App\Electrics;
use Illuminate\Http\Request;

use App\Http\Requests;
use Mockery\CountValidator\Exception;

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
           // 'image' => 'required|image'
        ]);

        try {
            //добавление
            //$file = $request->file('image');
            //эта функция обрезает фото и сохраняет обрезанный вариант с оригиналом, возвращает имя файл
            //$file = $this->addImg($file);

            $electrics = new Electrics();
            $electrics->title = $request->input('title');
            $electrics->name = $request->input('name');
            $electrics->producer = $request->input('producer');
            $electrics->price = $request->input('price');
            $electrics->status = $request->input('status');
            $electrics->description = $request->input('description');
           // $electrics->img = $file->getClientOriginalName();
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
            Electrics::destroy($id);
            return redirect('/admin/electrics');
        } catch(Exception $e) {
            Log::error('Ошибка удаления');
            return redirect()->back();
        }
    }


    //  функция обрезает фото и сохраняет обрезанный вариант с оригиналом, возвращает имя файл
    public function addImg ($file) {
        $file->getClientOriginalName();
        $filePath = '/tmp/$file';
        if(is_file($filePath)){
            unlink("$filePath");
        }

        $image = Image::make($file)
            ->resize(100,null, function($constraint) {
                $constraint->aspectRatio();
            })
            ->save('./tmp/cut-'.$file->getClientOriginalName());

        $file->move('tmp', $file->getClientOriginalName());
        $file->getClientOriginalName();
        return $file;
    }
}
