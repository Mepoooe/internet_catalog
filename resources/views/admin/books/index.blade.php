@extends ('layouts.app')

@section('sidebar')
    @include('layouts.sidebar_admin')
@endsection

@section('content')
    <h1 class="col-sm-12">Учебники</h1>
    <div class="col-sm-9 col-sm-push-3">
        <a class="btn btn-success btn-block btn-lg text-uppercase" data-toggle="modal" data-target="#add"
           href="#">
            <i class="fa fa-plus-square-o "></i>
            Добавить товар</a>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Автор</th>
                    <th>Тема</th>
                    <th>Издательство</th>
                    <th>Обложка</th>
                    <th>Цена</th>
                    <th>Картинка</th>
                </tr>
                @for ($i = 0; $i < count($books); $i++)
                    <tr>
                        @foreach ($books[$i] as $key => $element)
                            <td>
                                @if ($key == 'img')
                                    <img src="/tmp/cut-{{$element}}" alt="images" >
                                    {{$element = null}}
                                @endif
                                {{$element}}
                            </td>
                        @endforeach
                        <td>
                            <a class="btn btn-warning" href="{{url('/admin/books/'.$books[$i]['id'].'')}}" title="Редактировать запись">
                                <i class="fa fa-edit"></i></a>
                        </td>
                        <td>
                            <a class="btn btn-danger" href="{{url('/admin/books/'.$books[$i]['id'].'')}}" title="Удалить запись">
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
                    <h4 class="modal-title text-uppercase text-center" id="myModalLabel">Добавить телофон</h4>
                </div>
                <div class="modal-body">
                    <form action="/admin/books" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="name">Название книги</label>
                            <input id="name" name="name" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="color">Автор</label>
                            <input id="color" name="author" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="color">Издетельство</label>
                            <input id="color" name="publisher" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Цена</label>
                            <input id="price" name="price" type="number" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="display">Раздел</label>
                            <select name="topic" id="display">
                                <option value="Экономика">Экономика</option>
                                <option value="Биология">Биология</option>
                                <option value="Программирование">Программирование</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Описание</label>
                            <textarea id="description" name="description" type="text" class="form-control" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="image">Обложка</label>
                            <input id="image" name="image" type="file" class="form-control" required>
                        </div>

                        <input type="submit" class="btn btn-success">
                        {{csrf_field()}}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
