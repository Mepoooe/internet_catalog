<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use Illuminate\Http\Request;
use App\Books;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
use File;

class BooksController extends Controller
{
    /**
     * Create a new controller instance.
     */

    public function __construct()
    {// проверка, в данном случае проверяет авторизован или нет
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     */

    public function create() {
        $books = array();
        return view('admin.books.index', $books);
    }

    // для помещения нового объекта в базу
    public function store(Request $request, $id=null) {
        $this->validate($request, [
            'price'       => 'required|numeric',
            'name'        => 'required|max:255',
            'topic'       => 'required|max:255',
            'publisher'   => 'required|max:255',
            'author'      => 'required|max:255',
            'description' => 'required|max:2000',
            'image'       => 'required|image'
        ]);

        try {

            //добавление 
            $file = $request->file('image');
            //эта функция обрезает фото и сохраняет обрезанный вариант с оригиналом, возвращает имя файл
            $file = $this->addImg($file);

            //добавление в бд
            Log::notice('Успех записи');
            $book = new Books();
            $book->name = $request->input('name');
            $book->price = $request->input('price');
            $book->author = $request->input('author');
            $book->topic = $request->input('topic');
            $book->publisher = $request->input('publisher');
            $book->description = $request->input('description');
            $book->img = $file->getClientOriginalName();
            $book->save();

            //возвращаем то что в бд
            $books = Books::all()->toArray();
            $data['books'] = $books;
            return view('admin.books.index', $data);
        } catch(Exception $e) {
            Log::error('Ошибка записи');
            return redirect('/home');
        }
    }

    // отображения формы и функция для получения
    public function edit($id) {
        try {
            $books = Books::find($id);
            $data['books'] = $books;
            $data['id'] = $id;
            return view('admin.books.index', $data);
        } catch (Exception $e) {
            Log::error('Ошибка ');
            return redirect()->back();
        }
    }

    //  функция для редактирования получает с edit 


    // отображение списока файлов 
    public function index() {
        $books = Books::all()->toArray();
        $data['books'] = $books;
        return view('admin.books.index', $data);
    }

    // удаление файла 
    public function destroy($id=null) {
        if ($id==null) {
            $books = Books::all()->toArray();
            $data['books'] = $books;
            return view('/admin.books.index', $data);
        }
        try {
            $books = Books::where('id', '=', $id)->find($id);
            if ($books == null) {
                $books = Books::all()->toArray();
                $data['books'] = $books;
                return view('/admin.books.index', $data);
            }
            $imgName = $books->img;

            //удаление файла из папки tmp
            $filePath = "./tmp/".$imgName;

            if(is_file($filePath)){
                File::delete("./tmp/cut-".$imgName);
                File::delete("./tmp/".$imgName);
            }
            Books::destroy($id);
            $books = Books::all()->toArray();
            $data['books'] = $books;
            $data['id'] = $id;
            return view('admin.books.index', $data);
        } catch (Exception $e) {
            Log::error('Ошибка записи');
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
            ->resize(100,100, function($constraint) {
                $constraint->aspectRatio();
            })
            ->save('./tmp/cut-'.$file->getClientOriginalName());

        $file->move('tmp', $file->getClientOriginalName());
        $file->getClientOriginalName();
        return $file;
    }


}
