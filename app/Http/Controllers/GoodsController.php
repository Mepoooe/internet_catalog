<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
use Mockery\CountValidator\Exception;

use App\Good;

class GoodsController extends Controller
{   
    // мы сделали группировку в роуте, но можно и так
    /*public function __construct() {
        $this->middleware('auth');
    }*/
    // функция выводит форму
    public function create() {
        return view('goods/create');
    }

    // для помещения нового объекта в базу
    public function store(Request $request) {
<<<<<<< HEAD
        $this->validate($request, [
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'image' => 'image'
        ]);

=======
>>>>>>> daf2e8de3fe18e484c8f47b68da3b1631d547ca6
        try {
            $file = $request->file('image');
            $file->move('tmp', $file->getClientOriginalName());

            Log::notice('Успех записи');
            $good = new Good();
            $good->name = $request->input('name');
            $good->price = $request->input('price');
            $good->user_id = Auth::user()->id;
            $good->save();
        } catch(Exception $e) {
            Log::error('Ошибка записи');
            return redirect('/home');
        }
    }

    // отображения формы и функция для поулчения
    public function edit($id) {

    }

    //  функция для редактирования получает с edit 
    public function update($id) {

    }

    // отображение списока файлов 
    public function index() {
        $goods = Good::with('userdata')->get();
        $data['goods'] = $goods;
        return view('goods/index', $data);
    }

    // отображение списока файлов 
    public function destroy($id) {

    }

}
