@extends ('layouts.app')
    
@section('sidebar')

    <div class="col-xs-3 col-sm-pull-9">
        <div class="sidebar">
            <div class="panel panel-primary">
                <div class="panel-heading">Фильтр</div>
                <div class="panel-body">
                    <form action="">
                        <ul class="list-group">
                            <li class="list-group-item" >
                             <label>Тип напитка:</label>
                                <div class="checkbox">
                                   
                                    <label>
                                      <input type="checkbox" name="type_alco" value="">
                                      Алкогольные
                                    </label><br>
                                    <label>
                                      <input type="checkbox" name="type_soft" value="">
                                      Безалкогольные
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item" >
                                <label>Цена:</label>
                                <div class="checkbox">
                                   
                                    <label>Минимальная цена
                                      <input class="form-control" type="text" name="min_price" value="">
                                      
                                    </label><br>
                                    <label>Максимальная цена
                                      <input class="form-control" type="text" name="max_price" value="">
                                      
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item" >
                                <label>Объем:</label>
                                <div class="checkbox">
                                    <label>Введите объем в мл
                                      <input class="form-control" type="text" name="min_price" value="">
                                    </label>
                                </div>
                            </li>

                        </ul>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('content')
@include('layouts/nav')
    <h1 class="col-sm-12">Напитки</h1>
    <div class="col-sm-9 col-sm-push-3">
        <a class="btn btn-success btn-block btn-lg text-uppercase"
           href="{{url('/admin/createDrinks')}}">Добавить напиток</a>
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
                        <a href="{{url('/admin/updateDrinks/'.$drinks[$i]['id'].'')}}">Редактировать запись</a>
                    </td>
                    <td>
                        <a href="{{url('/admin/drinks/'.$drinks[$i]['id'].'')}}">Удалить запись</a>
                    </td>

                </tr>
            @endfor
        </table>
    </div>
    
@endsection