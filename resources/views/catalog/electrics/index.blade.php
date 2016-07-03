@extends ('layouts.app')

@section('content')
    @include('layouts.nav')
    <div class="row row-offcanvas row-offcanvas-left">

        <div class="col-xs-10 col-sm-8">
            <div class="row">

                @for ($i = 0; $i < count($electrics); $i++)
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <img src="/tmp/{{$electrics[$i]['img']}}" alt="images" width="300" height="200">
                            <div class="caption">
                                <h3>{{$electrics[$i]['title']}}</h3>
                                <p><strong>Марка:</strong> {{$electrics[$i]['name']}}</p>
                                <p><strong>Производитель:</strong> {{$electrics[$i]['producer']}}</p>
                                <p><strong>Цена:</strong> {{$electrics[$i]['price']}}</p>
                                <p><strong>Наличие: </strong>{{$electrics[$i]['status']}}</p>
                                <p><strong>Описание:</strong> {{$electrics[$i]['description']}}</p>
                                <p><a href="#" class="btn btn-primary" role="button">Заказать</a></p>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
            <div class="list-group">
                <div class="sidebar">
                    <h3 class="filterName">Фильтр</h3>
                    <div class="panel-body">
                        <form action="/catalog/electrics">
                            <ul class="list-group">
                                <li class="list-group-item" >
                                    <label for="producer">Производитель: </label><br>
                                    <select name="producer" id="producer">
                                        @for($i = 0; count($electrics) > $i; $i++)
                                            <option value="{{$electrics[$i]['producer']}}">
                                                {{$electrics[$i]['producer']}}
                                            </option>
                                        @endfor
                                    </select>
                                </li>
                                <li class="list-group-item" >
                                    <label for="name">Марка: </label><br>
                                    <select name="name" id="name">
                                        @for($i = 0; count($electrics) > $i; $i++)
                                            <option value="{{$electrics[$i]['name']}}">
                                                {{$electrics[$i]['name']}}
                                            </option>
                                        @endfor
                                    </select>
                                </li>
                                <li class="list-group-item" >
                                    <label>Цена:</label>
                                    <label>От
                                        <input class="form-control" type="number" name="min_price" value="">
                                    </label><br>
                                    <label>До
                                        <input class="form-control" type="number" name="max_price" value="">
                                    </label>
                                </li>
                            </ul>
                            <button  class="btn btn-primary filterButton">Отфильтровать</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop