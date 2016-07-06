@extends ('layouts.app')

@section('sidebar')
    @include('layouts.sidebar_admin')
@endsection
@section('content')
            <div class="modal-body">
                    <form action="/admin/phones/{{$id}}" method="post" enctype="multipart/form-data">
                    
                        <div class="form-group">
                            <label for="name">Марка Телефона</label>
                            <input id="name" name="name" type="text" class="form-control" value="{{$phones['name']}}" required>
                        </div>
                        <div class="form-group">
                            <label for="color">Цвет</label>
                            <input id="color" name="color" type="text" class="form-control" value="{{$phones['color']}}" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Цена</label>
                            <input id="price" name="price" type="number" class="form-control" value="{{$phones['price']}}" required>
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
                            <textarea id="description" name="description" type="text" class="form-control" value="{{$phones['description']}}" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="image">Картинка товара</label>
                            <input id="image" name="image" type="file" class="form-control" required>
                        </div>

                        <input type="submit" class="btn btn-success">
                        {{csrf_field()}}
                    </form>
                </div>
@endsection