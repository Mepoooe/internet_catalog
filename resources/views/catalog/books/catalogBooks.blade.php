@extends ('layouts.app')

@section('content')
@include('layouts/nav')
    
    <div class="row row-offcanvas row-offcanvas-left">
        
        <div class="col-xs-10 col-sm-8">
          <div class="row">

            @for ($i = 0; $i < count($books); $i++)
                <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                                <img src="/tmp/{{$books[$i]['img']}}" alt="images" width="300" height="200">
                                    <div class="caption">
                                        <h3>{{$books[$i]['name']}}</h3>
                                        <p><b>Тема </b>{{$books[$i]['topic']}}</p>
                                        <p><b>Автор </b>{{$books[$i]['author']}}</p>
                                        <p><b>Издательство </b>{{$books[$i]['publisher']}}</p>
                                        <p><b>Описание /<b>{{$books[$i]['description']}}</p>
                                        <p><b>Цена </b>{{$books[$i]['price']}}</p>
                                        <p><a href="" class="btn btn-primary" role="button">Заказать</a></p>
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
                    <form action="/catalog/catalogBooks/">
                        <ul class="list-group">
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
                        </ul>
                        <button  class="btn btn-primary filterButton">Отфильтровать</button>
                    </form>
                </div>
        </div><!--/span-->
    </div>   
@endsection