<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Drinks;
use Illuminate\Support\Facades\Log;

class DrinksController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {// проверка, в данном случае проверяет авторизован или нет
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function index()
    {
        return view('admin/tables/drinks');
    }*/

    public function create() {
        return view('/admin/tables/createDrinks');
    }

    // для помещения нового объекта в базу
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'volume' => 'required|numeric',
            'image' => 'image'
        ]);

        try {
            $file = $request->file('image');
            $file->move('tmp', $file->getClientOriginalName());

            Log::notice('Успех записи');
            $drink = new Drinks();
            $drink->name = $request->input('name');
            $drink->price = $request->input('price');
            $drink->volume = $request->input('volume');
            $drink->save();
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
        $drinks = Drinks::all()->toArray();
        $data['drinks'] = $drinks;
        return view('admin/tables/drinks', $data);
    }

    // отображение списока файлов 
    public function destroy($id) {

    }
}
