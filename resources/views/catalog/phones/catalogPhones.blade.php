@extends ('layouts.app')

@section('content')
  @include('layouts/nav')
    
    <div class="row row-offcanvas row-offcanvas-left">
        
        <div class="col-xs-10 col-sm-8">
          <div class="row">

            @for ($i = 0; $i < count($phones); $i++)
                <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                                <img src="/tmp/{{$phones[$i]['img']}}" alt="images" width="300" height="200">
                              <div class="caption">
                                <h3>{{$phones[$i]['name']}}</h3>
                                <p>Цвет: {{$phones[$i]['color']}}</p>
                                <p>Цена: {{$phones[$i]['price']}}</p>
                                <p>Дисплей: {{$phones[$i]['display']}}</p>
                                <p>Описание: {{$phones[$i]['description']}}</p>
                                <p><a href="/catalog/phones/order/{{$phones[$i]['id']}}" class="btn btn-primary" role="button">Заказать</a></p>
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
                    <form action="/catalog/catalogPhones/" method="get">
                        <ul class="list-group">
                            <li class="list-group-item" >
                             <label>Цвет:</label>
                                <div class="checkbox">
                                    <select name="color" class="form-control" id="display">
                                      <option value="all">Все</option>
                                      <option value="black">Черный</option>
                                      <option value="red">Красный</option>
                                      <option value="yellow">Желтый</option>
                                      <option value="grey">Серый</option>
                                    </select>
                                </div>
                            </li>
                            <li class="list-group-item" >
                                <label>Цена:</label>
                                <div class="checkbox">
                                   
                                    <label>Минимальная цена
                                      <input class="form-control" type="text" name="min_price" placeholder="От" >
                                      
                                    </label><br>
                                    <label>Максимальная цена
                                      <input class="form-control" type="text" name="max_price" placeholder="До" >
                                      
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item" >
                                <label>Дисплей:</label>
                                <div>
                                    <select name="display" class="form-control" id="display">
                                      <option value="all">Все</option>
                                      <option value="6">6</option>
                                      <option value="5">5</option>
                                      <option value="4">4</option>
                                    </select>
                                </div> 
                            </li>

                        </ul>
                        <button  class="btn btn-primary filterButton">Отфильтровать</button>
                    </form>
                </div>
        </div><!--/span-->
 
        <?php
        if(!function_exists('render')){
             echo $phones->links();
            }
        ?>
    </div>
@endsection