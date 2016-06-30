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
        try {
            $electrics = new Electrics();
            $electrics->title = $request->input('title');
            $electrics->name = $request->input('name');
            $electrics->producer = $request->input('producer');
            $electrics->price = $request->input('price');
            $electrics->status = $request->input('status');
            $electrics->description = $request->input('description');
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
}
