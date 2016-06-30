@extends ('layouts.app')

@section('content')
    @if(!empty($errors->all()))
        @foreach ($errors->all()->atributs as $error )
        <li>{{$error}}</li>
        @endforeach
    @endif
    <div class="row">
    <div class="col-md-6 col-md-offset-3">
        <form action="/admin/drinks" method="post" enctype="multipart/form-data">
        <div class="col-sm-10">
            <label class="col-sm-5 control-label" for="exampleInputName1">Название бутылки</label>
            <input id="exampleInputName1" class="form-control" type="text" name="name">
        </div>
        <div class="col-sm-10">
            <label class="col-sm-4 control-label" for="exampleInputName2">Цена за единицу</label> <input class="form-control" id="exampleInputName2" type="text" name="price"></label>
        </div>
        <div class="col-sm-10">
            <label class="col-sm-4 control-label" for="exampleInputName3">Объем</label> 
            <input id="exampleInputName3" class="form-control" type="text" name="volume">
        </div>
        <div class="col-sm-10">
            <label class="col-sm-4 control-label" >Тип напитка:</label> 
            <div class="radio">
            
            <label class="control-label">
                    <input type="radio" name="typeDrink" value="alco"> Алкогольный 
            </label>
            <label class="control-label">
                <input type="radio" name="typeDrink" value="soft"> Безалкогольный
                </div>
            </label> <br>
            </div>
            <div class="col-sm-10">
                <label id="exampleInputFile" class="col-sm-4 control-label">Катринка</label>
                <input type="file" id="exampleInputFile" name="image"></label> 
            </div>
            <div class="col-sm-10">
                <button  class="btn btn-success">Отправить</button>
            </div>
            {{csrf_field()}}
        </form>
    </div>
</div>
@endsection