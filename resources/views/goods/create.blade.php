@extends ('layouts.app')

@section('content')
    <form action="/goods/store" method="post" enctype="multipart/form-data">
        <label for="">Имя  <input type="text" name="name"></label> 
        <label for="">Цена  <input type="text" name="price"></label> 
        <label for="">файл <input type="file" name="image"></label> 
        <button>Отправить</button>
        {{csrf_field()}}
    </form>
@endsection