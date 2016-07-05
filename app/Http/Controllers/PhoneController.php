<?php

namespace App\Http\Controllers;

use App\Phones;
use Illuminate\Http\Request;

use App\Http\Requests;
use Mockery\CountValidator\Exception;
use Intervention\Image\Facades\Image ;
use Illuminate\Support\Facades\File;

use Faker\Factory as GeneratorShtuchek;

class PhoneController extends Controller
{
    public function index()
    {
        $data['phones'] = Phones::all()->toArray();
        return view('admin/phones/phones', $data);
    }

    /*
     * Добавление записи в DB
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'color' => 'required|string',
            'price' => 'required|numeric',
            'display' => 'required',
            'description' => 'required',
            'image' => 'required|image'
        ]);

        try {
            //добавление картинки
            $file = $request->file('image');
            //эта функция обрезает фото и сохраняет обрезанный вариант с оригиналом, возвращает имя файл
            $file = $this->addImg($file);

            $Phones = new Phones();
            $Phones->name = $request->input('name');
            $Phones->color = $request->input('color');
            $Phones->price = $request->input('price');
            $Phones->display = $request->input('display');
            $Phones->description = $request->input('description');
            $Phones->img = $file;
            $Phones->save();
        } catch(Exception $e) {
            Log::error('Ошибка записи');
            return redirect('/admin/');
        }

        return redirect('/admin/phones');
    }

    /*
     * Удаление записи с DB
     */
    public function destroy($id = null)
    {
        try {
            $el = Phones::where('id', '=', $id)->find($id);
            $imgName = $el->img;

            $filePath = "./tmp/" .$imgName;

            if(is_file($filePath)){
                File::delete("./tmp/cut-" .$imgName);
                File::delete("./tmp/" .$imgName);
            }

            Phones::destroy($id);

            return redirect('/admin/phones');
        } catch(Exception $e) {
            Log::error('Ошибка удаления');
            return redirect()->back();
        }
    }

    // форма редактирования
     public function edit($id=null) {
        try {
        $phones = Phones::find($id);
        $data['phones'] = $phones;
        $data['id'] = $id;
        return view('admin/phones/updatePhone', $data);
        } catch (Exception $e) {
            Log::error('Ошибка ');
            return redirect()->back();
        }
    }

    // редактирование записи
    public function update(Request $request, $id=null) {

        $this->validate($request, [
            'name' => 'string',
            'color' => 'string',
            'price' => 'numeric',
            'display' => 'numeric',
            'description' => 'string',
            'image' => 'required|image'
        ]);
        try {
        //if ($id==null) {
        //    return redirect('/admin/phones');
        //}
        //удаление файла из папки tmp
        $phones = Phones::where('id', '=', $id)->find($id);
        $imgName = $phones->img;

        $filePath = "./tmp/".$imgName;

        if(is_file($filePath)){
            File::delete("./tmp/cut-".$imgName);
            File::delete("./tmp/".$imgName);
        }
        $phones = Phones::find($id);
        $post = $request->toArray();
        $post = $post['image'];
        $file = $this->addImg($post);
            $phones->name = $request->input('name');
            $phones->color = $request->input('color');
            $phones->price = $request->input('price');
            $phones->description = $request->input('description');
            $phones->img = $file;
            $phones->save();
        $allDrinks = Phones::all()->toArray();
        $data['phones'] = $allDrinks;
        $data['id'] = $id;
        return view('/admin/phones/phones', $data);
        // сделать модель для фото добавления и удаления
        } catch (Exception $e) {
            Log::error('Ошибка ');
            return redirect()->back();
        }
    }

    //faker
    public function faker () {
        $faker = \Faker\Factory::create();

        $limit = 10;

        for ($i = 0; $i < $limit; $i++) {

            $Phones = new Phones();
            $Phones->name = $faker->name;
            $Phones->color = $faker->colorName ;
            $Phones->price = $faker->randomNumber(3);
            $Phones->display = $faker->randomNumber(2);
            $Phones->description = $faker->catchPhrase;
            $Phones->img = $faker->image;
            $Phones->save();
        }
        $phones = Phones::paginate(6);
        $data['phones'] = $phones;
        return view('catalog/phones/catalogPhones', $data);
    }

    //  функция обрезает фото и сохраняет обрезанный вариант с оригиналом, возвращает имя файл
    public function addImg ($file) {
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
        // лучше сделать отдельный файл с доп функциями
    }
}
