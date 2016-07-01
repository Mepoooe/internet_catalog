@extends ('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-6 col-md-offset-3">
    @if(!empty($errors->all()))
            <table class="table table-condensed">
                
                @foreach ($errors->all() as $error)
                <tr>
                    <td class="danger">{{ $error }}</td>
                </tr>
                @endforeach
            </table>
    @endif
        <form action="/admin/drinks/{{$id}}" method="post" enctype="multipart/form-data">
        <div class="col-sm-10">
            <label class="col-sm-5 control-label" for="exampleInputName1">Название бутылки</label>
            <input id="exampleInputName1" class="form-control" type="text" name="name" value="{{$drinks['name']}}">
        </div>
        <div class="col-sm-10">
            <label class="col-sm-4 control-label" for="exampleInputName2">Цена за единицу</label> <input class="form-control" id="exampleInputName2" type="text" name="price" value="{{$drinks['price']}}"></label>
        </div>
        <div class="col-sm-10">
            <label class="col-sm-4 control-label" for="exampleInputName3">Объем</label> 
            <input id="exampleInputName3" class="form-control" type="text" name="volume" value="{{$drinks['volume']}}">
        </div>
        <div class="col-sm-10">
            <label class="col-sm-4 control-label" >Тип напитка:</label> 
            <div class="radio">
            
            <label class="control-label">
                    <input type="radio" name="type_drinks" value="alco"
                    @if ($drinks['type_drinks']=='alco')
                            checked
                    @endif
                    > Алкогольный 
            </label>
            <label class="control-label">
                <input type="radio" name="type_drinks" value="soft"
                @if ($drinks['type_drinks']=='soft')
                        checked
                @endif
                > Безалкогольный
                </div>
            </label> <br>
            </div>
            <div class="col-sm-10">
                <label id="exampleInputFile" class="col-sm-4 control-label">Катринка</label>
                <input type="file" id="exampleInputFile" name="img" value="{{$drinks['img']}}"></label> 
            </div>
            <div class="col-sm-10">

                <button  class="btn btn-success">Отправить</button>
            </div>
            {{csrf_field()}}
        </form>
    </div>
</div>
@endsection