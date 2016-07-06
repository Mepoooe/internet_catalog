@extends ('layouts.app')

@section('content')
    @if(!empty($errors->all()))
        <table class="table table-condensed">
            @foreach ($errors->all() as $error)
                <tr>
                    <td class="danger">{{ $error }}</td>
                </tr>
            @endforeach
        </table>
    @endif
    <div class="col-sm-offset-3 col-sm-5 col-sm-offset-3">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h4>Редактирование товара</h4>
            </div>
            <div class="panel-body">
                <form action="/admin/electrics/{{ $electrics['id'] }}" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="title">Заголовок/Название товара</label>
                        <input id="title" name="title" type="text" class="form-control"
                               value="{{ $electrics['title'] }}" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Марка</label>
                        <input id="name" name="name" type="text" class="form-control"
                               value="{{ $electrics['name'] }}" required>
                    </div>
                    <div class="form-group">
                        <label for="producer">Производитель</label>
                        <input id="producer" name="producer" type="text" class="form-control"
                               value="{{ $electrics['producer'] }}" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Цена</label>
                        <input id="price" name="price" type="number" class="form-control"
                               value="{{ $electrics['price'] }}" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Статус</label>
                        <select name="status" id="status">
                            @if($electrics['status'] == 'есть в наличии')
                                <option value="нет в наличии">нет в наличии</option>
                                <option selected value="есть в наличии">есть в наличии</option>
                            @else
                                <option selected value="нет в наличии">нет в наличии</option>
                                <option value="есть в наличии">есть в наличии</option>
                            @endif

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Описание</label>
                <textarea id="description" name="description" type="text" class="form-control" required>{{ $electrics['description'] }}
                </textarea>
                    </div>

                    <div class="form-group">
                        <label for="image">Картинка товара</label>
                        <input id="image" name="image" type="file" class="form-control">
                    </div>

                    <input type="submit" class="btn btn-success">
                    {{csrf_field()}}
                </form>
            </div>
        </div>


    </div>

@stop