<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Books;

class CatalogBooksController extends Controller
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
        $books = Books::all()->toArray();
        $data['books'] = $books;
        return view('catalog/books/catalogBooks', $data);
    }

    public function filter(Request $request, $id=null)
    {
        $this->validate($request, [
            'min_price' => 'numeric',
            'max_price'   => 'numeric'
        ]);
        $filterValue = array();
        $filterValue['min_price']  = $request->input('min_price');
        $filterValue['max_price']  = $request->input('max_price');

        if ($filterValue['max_price'] != '') {
            $books = Books::where('price', '<=', $filterValue['max_price'])
                ->where('price', '>=', $filterValue['min_price'])
                ->get();
        } else {
            $books = Books::where('price', '>=', $filterValue['min_price'])->get();
        }
       
        $data['books'] = $books;
        $data['arr'] = $filterValue;

        return view('catalog/books/catalogBooks', $data);
    }
}
