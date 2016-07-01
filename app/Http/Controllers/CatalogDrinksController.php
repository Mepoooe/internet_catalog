<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Drinks;

class CatalogDrinksController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // доступ без авторизации
    /*public function __construct()
    {// проверка, в данном случае проверяет авторизован или нет
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drinks = Drinks::all()->toArray();
        $data['drinks'] = $drinks;
        return view('catalog/drinks/catalogDrinks', $data);
    }

    public function filter(Request $request, $id=null)
    {
        $this->validate($request, [
            'type_alco' => 'string',
            'type_soft' => 'string',
            'min_price' => 'numeric',
            'max_price'   => 'numeric',
            'volume' => 'numeric'
        ]);
        $filterValue = array();
        $filterValue['type_alco'] = $request->input('type_alco');
        $filterValue['type_soft']  = $request->input('type_soft');
        $filterValue['min_price']  = $request->input('min_price');
        $filterValue['max_price']  = $request->input('max_price');
        $filterValue['volume']  = $request->input('volume');

        //$drinks = Drinks::all()->toArray();
        
        
        if ($filterValue['max_price'] != '') {
            $drinks = Drinks::where('price', '<=', $filterValue['max_price'])
                                ->where('price', '>=', $filterValue['min_price'])
                                ->get();
        } else {
            $drinks = Drinks::where('price', '>=', $filterValue['min_price'])->get();
        }
        if ($filterValue['type_alco'] != '' && $filterValue['type_soft'] == '') {
         $drinks = Drinks::where('type_drinks', '=', $filterValue['type_alco'])
                          ->get();
        }
        if ($filterValue['type_soft'] != '' && $filterValue['type_alco'] == '') {
         $drinks = Drinks::where('type_drinks', '=', $filterValue['type_soft'])
                          ->get();
        }
        /*if ($filterValue['type_soft'] != '' && $filterValue['type_alco'] != '') {
         $drinks = Drinks::where('type_drinks', '=', $filterValue['type_soft'])
                            ->where('type_drinks', '=', $filterValue['type_alco'])
                          ->get();
        }*/
        if ($filterValue['volume'] != '') {
            $drinks = Drinks::where('volume', '=', $filterValue['volume'])->get();
        }
        $data['drinks'] = $drinks;
        $data['arr'] = $filterValue;
        
        return view('catalog/drinks/catalogDrinks', $data);
    }
}
