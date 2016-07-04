@extends ('layouts.app')

@section('content')
    @include('layouts/nav')

    <div class="row row-offcanvas row-offcanvas-left">

        <div class="col-xs-10 col-sm-8">
            <div class="row">

                @for ($i = 0; $i < count($drinks); $i++)
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <img src="/tmp/{{$drinks[$i]['img']}}" alt="images" width="300" height="200">
                            <div class="caption">
                                <h3>{{$drinks[$i]['name']}}</h3>
                                <p>Обьем: {{$drinks[$i]['volume']}}</p>
                                <p>Цена: {{$drinks[$i]['price']}}</p>
                                <p>Алкогольность: {{$drinks[$i]['type_drinks']}}</p>
                                <p><a href="/catalog/drinks/order/{{$drinks[$i]['id']}}" class="btn btn-primary" role="button">Заказать</a></p>
                              </div>
                            </div>
                        </div>
                    
                @endfor
            </div>
        </div>
    </div>

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
            <div class="list-group">
                <div class="sidebar">
                    <h3 class="filterName">Фильтр</h3>
                    <div class="panel-body">
                        <form action="/catalog/catalogDrinks/">
                            <ul class="list-group">
                                <li class="list-group-item" >
                                    <label>Тип напитка:</label>
                                    <div class="checkbox">

                                        <label>
                                            <input type="checkbox" name="type_alco" value="alco">
                                            Алкогольные
                                        </label><br>
                                        <label>
                                            <input type="checkbox" name="type_soft" value="soft">
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
                                            <input class="form-control" type="text" name="volume" value="">
                                        </label>
                                    </div>
                                </li>

                            </ul>
                             <button  class="btn btn-primary filterButton">Отфильтровать</button>
                        </form>
                    </div>
                </div><!--/span-->
    
                <?php 
                if(!function_exists('render')){
                     echo $drinks->render(); 
                 }
                ?>
            </div>   
        </div>
@endsection