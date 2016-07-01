@extends ('layouts.app')

@section('sidebar')
    <div class="col-sm-3 col-sm-pull-9">
        <div class="sidebar">
            <div class="panel panel-primary">
                <div class="panel-heading">Категории товаров:</div>
                <div class="panel-body">
                    <ul class="list-group">
                        <li class="list-group-item" >
                            <a href="{{ url('/admin/drinks') }}">Напитки</a>
                        </li>
                        <li class="list-group-item" >
                            <a href="{{ url('/admin/electrics') }}">Електротовары</a>
                        </li>
                        <li class="list-group-item" >
                            <a href="{{ url('#') }}">Тест</a>
                        </li>
                        <li class="list-group-item" >
                            <a href="{{ url('#') }}">Тест</a>
                        </li>

                    </ul>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('content')
    <h1 class="col-sm-12">Напитки</h1>
    <div class="col-sm-9 col-sm-push-3">
        <a class="btn btn-success btn-block btn-lg text-uppercase"
           href="{{url('/admin/createDrinks')}}">
            <i class="fa fa-plus-square-o "></i>
            Добавить напиток</a>
        <table class="table table-striped">
            @for ($i = 0; $i < count($drinks); $i++)
                <tr>
                    @foreach ($drinks[$i] as $key => $element)
                        <td>
                            @if ($key == 'img')
                                <img src="/tmp/cut-{{$element}}" alt="images" >
                                {{$element = null}}
                            @endif
                            {{$element}}
                        </td>
                    @endforeach
                    <td>
                        <a class="btn btn-warning" href="{{url('/admin/updateDrinks/'.$drinks[$i]['id'].'')}}">
                            <i class="fa fa-edit"></i>
                            Редактировать</a>
                    </td>
                    <td>
                        <a class="btn btn-danger" href="{{url('/admin/drinks/'.$drinks[$i]['id'].'')}}">
                            <i class="fa fa-trash-o"></i>
                            Удалить</a>
                    </td>

                </tr>
            @endfor
        </table>
    </div>
<<<<<<< HEAD
=======
    
>>>>>>> origin/misha_nik
@endsection