@extends ('layouts.app')



@section('content')

    <h1>Админка</h1>
    @section('sidebar')
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
                            <a href="{{ url('admin/phones') }}">Телефоны</a>
                        </li>
                        <li class="list-group-item" >
                            <a href="{{ url('#') }}">Тест</a>
                        </li>

                    </ul>
                </div>
            </div>

        </div>
    @endsection
@endsection