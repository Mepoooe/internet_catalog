<?php

namespace App\Http\Controllers;

use App\Electrics;
use App\goodsImage;
use Illuminate\Http\Request;

use App\Http\Requests;
use Mockery\CountValidator\Exception;
use Intervention\Image\Facades\Image;
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
            'title'       => 'required|max:255',
            'name'        => 'required',
            'producer'    => 'required',
            'price'       => 'required|numeric',
            'status'      => 'required',
            'description' => 'required',
            'image'       => 'required|image'
        ]);

        try {
            //добавление картинки
            $file = $request->file('image');
            //эта функция обрезает фото и сохраняет обрезанный вариант с оригиналом, возвращает имя файл
            $file = $this->addImg($file);

            $electrics = new Electrics();
            $electrics->title       = $request->input('title');
            $electrics->name        = $request->input('name');
            $electrics->producer    = $request->input('producer');
            $electrics->price       = $request->input('price');
            $electrics->status      = $request->input('status');
            $electrics->description = $request->input('description');
            $electrics->img         = $file->getClientOriginalName();
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
            $el = Electrics::where('id', $id)->find($id);
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
    /*
     * Редактирование записи
     */
    public function edit($id = null)
    {
        try {
            $data['electrics'] = Electrics::find($id);;
            $data['id'] = $id;
            return view('/admin/electrics/edit', $data);
        } catch(Exception $e) {
            Log::error('Ошибка ');
            return redirect()->back();
        }
    }

    public function update(Request $request, $id = null)
    {
        $this->validate($request, [
            'title' => 'max:255',
            'price' => 'numeric',
            'image' => 'required|image'
        ]);

        try {
            $el = Electrics::where('id', $id)->find($id);
            $imgName = $el->img;

            $filePath = "./tmp/" .$imgName;

            if(is_file($filePath)){
                File::delete("./tmp/cut-" .$imgName);
                File::delete("./tmp/" .$imgName);
            }
            $el = Electrics::find($id);

            $post = $request->toArray();
            $file = $this->addImg($post['image']);

            $el->title       = $request->input('title');
            $el->name        = $request->input('name');
            $el->producer    = $request->input('producer');
            $el->price       = $request->input('price');
            $el->status      = $request->input('status');
            $el->description = $request->input('description');
            $el->img         = $file->getClientOriginalName();
            $el->save();

            return redirect('/admin/electrics');
        } catch(Exception $e) {
            Log::error('Ошибка редактирования');
            return redirect()->back();
        }
    }

    /*
     * Front methods
     */
    public function catalog()
    {
        $data['electrics'] = Electrics::all()->toArray();
        return view('/catalog/electrics/index', $data);
    }

    public function filter(Request $request, $id = null)
    {
        $this->validate($request, [
            'min_price' => 'numeric',
            'max_price' => 'numeric'
        ]);

        $filterValue = array();
        $filterValue['producer']   = $request->input('producer');
        $filterValue['name']       = $request->input('name');
        $filterValue['min_price']  = $request->input('min_price');
        $filterValue['max_price']  = $request->input('max_price');


        if ($filterValue['max_price'] != '') {
            $electrics = Electrics::where('price', '<=', $filterValue['max_price'])
                ->where('price', '>=', $filterValue['min_price'])
                ->get();
        } else {
            $electrics = Electrics::where('price', '>=', $filterValue['min_price'])->get();
        }
        if($filterValue['producer'] != 'все') {
            $electrics = Electrics::where('producer', '=', $filterValue['producer'])->get();
        }
        if($filterValue['name'] != 'все') {
            $electrics = Electrics::where('name', '=', $filterValue['name'])->get();
        }

        $data['electrics'] = $electrics;
        $data['arr'] = $filterValue;

        return view('catalog/electrics/index', $data);
    }

    /*
     * Functions
     */
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
