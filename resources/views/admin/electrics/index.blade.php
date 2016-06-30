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
    {{--{{dd($electrics)}}--}}
    <h1 class="col-sm-12">Електротовары</h1>
    <div class="col-sm-9 col-sm-push-3">
        <a class="btn btn-success btn-block btn-lg text-uppercase" data-toggle="modal" data-target="#add"
           href="{{url('#')}}">
            <i class="fa fa-plus-square-o "></i>
            Добавить товар</a>
        <div class="table-responsive">
            <table class="table table-striped">
                @for ($i = 0; $i < count($electrics); $i++)
                    <tr>
                        @foreach ($electrics[$i] as $key => $element)
                            <td>
                                @if ($key == 'img')
                                    <img src="/tmp/cut-{{$element}}" alt="images" >
                                    {{$element = null}}
                                @endif
                                {{$element}}
                            </td>
                        @endforeach
                        <td>
                            <a class="btn btn-warning" href="{{url('/admin/electrics/'.$electrics[$i]['id'].'')}}" title="Редактировать запись">
                                <i class="fa fa-edit"></i></a>
                        </td>
                        <td>
                            <a class="btn btn-danger" href="{{url('/admin/electrics/'.$electrics[$i]['id'].'')}}" title="Удалить запись">
                                <i class="fa fa-trash-o"></i></a>
                        </td>

                    </tr>
                @endfor
            </table>
        </div>

    </div>

    {{--============================ Pop Up ADD ============================--}}
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Добавить електротовары</h4>
                </div>
                <div class="modal-body">
                    <form action="/admin/electrics" method="post" enctype="multipart/form-data">
                        {{--{{dd($electrics)}}--}}
                        @foreach($electrics[0] as $key => $value)

                            @if($key !== 'id' && $key !== 'created_at' && $key !== 'updated_at')
                                <div class="form-group">
                                    <label for="{{$key}}"> {{$key}} </label>
                                    <input id="{{$key}}" name="{{$key}}" type="text" class="form-control">
                                </div>
                            @endif

                        @endforeach
                        <input type="submit" class="btn btn-success btn-lg">
                        {{csrf_field()}}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
