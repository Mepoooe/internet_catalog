<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Drinks;
use Mail;
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
    // вывод данных с пагинацией 
    public function index()
    {
        $drinks = Drinks::paginate(2);
        $data['drinks'] = $drinks;
        return view('catalog/drinks/catalogDrinks', $data);
    }
    // фильтр данных
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

        
        
        if ($filterValue['max_price'] != '') {
            $drinks = Drinks::where('price', '<=', $filterValue['max_price'])
                                ->where('price', '>=', $filterValue['min_price'])
                                ->paginate();
        } else {
            $drinks = Drinks::where('price', '>=', $filterValue['min_price'])->paginate();
        }
        if ($filterValue['type_alco'] != '' && $filterValue['type_soft'] == '') {
         $drinks = Drinks::where('type_drinks', '=', $filterValue['type_alco'])
                          ->paginate();
        }
        if ($filterValue['type_soft'] != '' && $filterValue['type_alco'] == '') {
         $drinks = Drinks::where('type_drinks', '=', $filterValue['type_soft'])
                          ->paginate();
        }
        if ($filterValue['volume'] != '') {
            $drinks = Drinks::where('volume', '=', $filterValue['volume'])->paginate();
        }
        $data['drinks'] = $drinks;
        $data['arr'] = $filterValue;
        
        return view('catalog/drinks/catalogDrinks', $data);
    }

    // Оформление заказа
    public function order($id = null)
    {
      $drinks = Drinks::find($id);
      $drinksArr['drinksName'] = $drinks->name;
      $drinksArr['drinksPrice'] = $drinks->price;
      $drinksArr['drinksImg'] = $drinks->img;

      $data['drinks'] = $drinksArr;
      $data['id'] = $id;

      return view('/catalog/drinks/order', $data);
    }

    // отправка почты
    public function sendOrder(Request $request, $id = null)
    {
      $this->validate($request, [
            'name' => 'string',
            'email' => 'required|email',
            'phone' => 'required|numeric'
        ]);
        $orderValue = array();
        $orderValue['name'] = $request->input('name');
        $orderValue['email'] = $request->input('email');
        $orderValue['phone'] = $request->input('phone');

      Mail::send('/catalog/drinks/mail', $orderValue, function($message) use ($orderValue)
        {
          $message->to($orderValue['email'], 'Джон Смит')->from('cj27111992@gmail.com')->subject('Привет!');
        });

      return redirect('/catalog/drinks');
    }
}
