<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Phones;
use Mail;

class CatalogPhonesController extends Controller
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
        $phones = Phones::paginate(2);
        $data['phones'] = $phones;
        return view('catalog/phones/catalogPhones', $data);
    }
    // фильтр данных
    public function filter(Request $request, $id=null)
    {
        $this->validate($request, [
            'color' => 'string',
            'display' => 'string',
            'min_price' => 'numeric',
            'max_price'   => 'numeric'
        ]);
        $filterValue = array();
        $filterValue['color'] = $request->input('color');
        $filterValue['display']  = $request->input('display');
        $filterValue['min_price']  = $request->input('min_price');
        $filterValue['max_price']  = $request->input('max_price');

        
        
        if ($filterValue['max_price'] != '') {
            $phones = Phones::where('price', '<=', $filterValue['max_price'])
                                ->where('price', '>=', $filterValue['min_price'])
                                ->paginate();
        } else {
            $phones = Phones::where('price', '>=', $filterValue['min_price'])->paginate();
        }
        if ($filterValue['display'] != '') {
         $phones = Phones::where('display', '=', $filterValue['display'])
                          ->paginate();
        }
        if ($filterValue['color'] != '' ) {
         $phones = Phones::where('color', '=', $filterValue['color'])
                          ->paginate();
        }
        $data['phones'] = $phones;
        $data['arr'] = $filterValue;
        
        return view('catalog/phones/catalogPhones', $data);
    }

    // отправка почты
    public function sendOrder($id = null)
    {
      Mail::send('/catalog/phones/mail', array('name' => 'Misha'), function($message)
        {
          $message->to('misha.nikula@yandex.ru', 'Джон Смит')->from('cj27111992@gmail.com')->subject('Привет!');
        });

      return redirect('/catalog/phones');
    }
}
