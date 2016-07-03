@extends ('layouts.app')

@section('sidebar')
    @include('layouts.sidebar_admin')
@endsection

@section('content')
    <h1 class="col-sm-12">Телефоны</h1>
    <div class="col-sm-9 col-sm-push-3">
        <a class="btn btn-success btn-block btn-lg text-uppercase" data-toggle="modal" data-target="#add"
           href="#">
            <i class="fa fa-plus-square-o "></i>
            Добавить товар</a>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <tr>
                    <th>ID</th>
                    <th>Заголовок/Название товара</th>
                    <th>Цвет</th>
                    <th>Цена</th>
                    <th>Дисплей</th>
                    <th>Описание</th>
                    <th>Фото</th>
                    <th>Время обновления </th>
                    <th>Время сознания</th>
                    <th></th>
                    <th></th>
                </tr>
                @for ($i = 0; $i < count($phones); $i++)
                    <tr>
                        @foreach ($phones[$i] as $key => $element)
                            <td>
                                @if ($key == 'img')
                                    <img src="/tmp/cut-{{$element}}" alt="images" >
                                    {{$element = null}}
                                @endif
                                {{$element}}
                            </td>
                        @endforeach
                        <td>
                            <a class="btn btn-warning"  href="{{url('/admin/updatePhones/'.$phones[$i]['id'].'')}}" title="Редактировать запись">
                                <i class="fa fa-edit"></i></a>
                        </td>
                        <td>
                            <a class="btn btn-danger" href="{{url('/admin/phones/'.$phones[$i]['id'].'')}}" title="Удалить запись">
                                <i class="fa fa-trash-o"></i></a>
                                <script>var id = function asset (id){return id;}</script>
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
                    <h4 class="modal-title text-uppercase text-center" id="myModalLabel">Добавить телофон</h4>
                </div>
                <div class="modal-body">
                    <form action="/admin/phones" method="post" enctype="multipart/form-data">
                    
                        <div class="form-group">
                            <label for="name">Марка Телефона</label>
                            <input id="name" name="name" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="color">Цвет</label>
                            <select id="color" name="color" class="form-control" >
                                      <option value="black">Черный</option>
                                      <option value="red">Красный</option>
                                      <option value="yellow">Желтый</option>
                                      <option value="grey">Серый</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="price">Цена</label>
                            <input id="price" name="price" type="number" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="display">Дисплей</label>
                            <select name="display" id="display">
                                <option value="6">6</option>
                                <option value="5">5</option>
                                <option value="4">4</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Описание</label>
                            <textarea id="description" name="description" type="text" class="form-control" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="image">Картинка товара</label>
                            <input id="image" name="image" type="file" class="form-control" required>
                        </div>

                        <input type="submit" class="btn btn-success">
                        {{csrf_field()}}
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--============================ Pop Up update ============================--}}
   <!--  <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                   <h4 class="modal-title text-uppercase text-center" id="myModalLabel">Редактировать запись с телофоном <script> innerHTML = id;</script></h4> 
               </div>
               <div class="modal-body">
                   <form action="/admin/phones/" method="post" enctype="multipart/form-data">
                       {{--@foreach($electrics[0] as $key => $value)
   
                           @if($key !== 'id' && $key !== 'created_at' && $key !== 'updated_at')
                               <div class="form-group">
                                   <label for="{{$key}}"> {{$key}} </label>
                                   <input id="{{$key}}" name="{{$key}}" type="text" class="form-control">
                               </div>
                           @endif
                       @endforeach--}}
                       <div class="form-group">
                           <label for="name">Марка Телефона</label>
                           <input id="name" name="name" type="text" class="form-control" required>
                       </div>
                       <div class="form-group">
                           <label for="color">Цвет</label>
                           <input id="color" name="color" type="text" class="form-control" required>
                       </div>
                       <div class="form-group">
                           <label for="price">Цена</label>
                           <input id="price" name="price" type="number" class="form-control" required>
                       </div>
                       <div class="form-group">
                           <label for="display">Дисплей</label>
                           <select name="display" id="display">
                               <option value="6">6</option>
                               <option value="5">5</option>
                               <option value="4">4</option>
                           </select>
                       </div>
                       <div class="form-group">
                           <label for="description">Описание</label>
                           <textarea id="description" name="description" type="text" class="form-control" required></textarea>
                       </div>
   
                       <div class="form-group">
                           <label for="image">Картинка товара</label>
                           <input id="image" name="image" type="file" class="form-control" required>
                       </div>
                           <input name="id" type="hidden" value="">
   
                       <input type="submit" class="btn btn-success">
                       {{csrf_field()}}
                   </form>
               </div>
           </div>
       </div>
   </div> -->

<script>
//перенос данных из элемента во всплывающее окно 
var copyData = function(button){ 
    var product = $(button).parents('.item-product'), 
    titleItem = $(product).find('.title-item'), 
    h5 = $(product).find('.h5-item').html(), 
    imgDescription = $(product).find('.img-description').html(), 
    advantage = $(product).find('.advantage-item').html(), 
    imageVert = $(product).find('.image-vert').attr('src'), 
    imageBottom = $(product).find('.img-bottom').attr('src'), 
    modal = $('#modal2'), 
    title=titleItem.html(), 
    bgColor = titleItem.attr('class'); 
    $(modal).find('.title-item').html(title); 
    $(modal).find('.title-item').attr('class',bgColor); 
    $(modal).find('.h5-item').html(h5); 
    $(modal).find('.img-description').html(imgDescription); 
    $(modal).find('.advantage-item').html(advantage); 
    $(modal).find('.image-vert').attr('src',imageVert); 
    $(modal).find('.img-bottom').attr('src',imageBottom); 
}
</script>
@endsection
