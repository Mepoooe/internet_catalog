@extends ('layouts.app')

@section('content')
    @if(!empty($errors->all()))
        @foreach ($errors->all()->atributs as $error )
        <li>{{$error}}</li>
        @endforeach
    @endif
    <form action="/admin/drinks/{{$id}}" method="post" enctype="multipart/form-data">
        <label for="">Название бутылки  <br><input type="text" name="name" value="{{$drinks['name']}}"></label> <br>
        <label for="">Цена за единицу <br> <input type="text" name="price" value="{{$drinks['price']}}"></label> <br>
        <label for="">Объем <br> <input type="text" name="volume" value="{{$drinks['volume']}}"></label> <br>
        <label for="">Тип напитка <br> 
        Алкогольный<input type="radio" name="type_drinks" value="alco"
        @if ($drinks['type_drinks']=='alco')
                checked
        @endif
        >
            Безалкогольный<input type="radio" name="type_drinks" value="soft"
        @if ($drinks['type_drinks']=='soft')
                checked
        @endif
        >
        </label> <br>
        <label for="">Катринка <br><input type="file" name="img" value="{{$drinks['img']}}"></label> 
        <button>Отправить</button>
        {{csrf_field()}}
    </form>
@endsection