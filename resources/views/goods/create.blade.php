@extends ('layouts.app')

@section('content')

    @if(!empty($errors->all()))
        @foreach ($errors->all()->atributs as $error )
        <li>{{$error}}</li>
        @endforeach
    @endif
    <form action="/goods/store" method="post" enctype="multipart/form-data">
        <label for="">Имя  <br><input type="text" name="name"></label> <br>
        <label for="">Цена <br> <input type="text" name="price"></label> <br>
        <label for="">файл <br><input type="file" name="image"></label> 

        <button>Отправить</button>
        {{csrf_field()}}
    </form>
@endsection