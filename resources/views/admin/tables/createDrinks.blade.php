@extends ('layouts.app')

@section('content')
    @if(!empty($errors->all()))
        @foreach ($errors->all()->atributs as $error )
        <li>{{$error}}</li>
        @endforeach
    @endif
    <form action="/admin/drinks" method="post" enctype="multipart/form-data">
        <label for="">Название бутылки  <br><input type="text" name="name"></label> <br>
        <label for="">Цена за единицу <br> <input type="text" name="price"></label> <br>
        <label for="">Объем <br> <input type="text" name="volume"></label> <br>
        <label for="">Катринка <br><input type="file" name="image"></label> 
        <button>Отправить</button>
        {{csrf_field()}}
    </form>
@endsection