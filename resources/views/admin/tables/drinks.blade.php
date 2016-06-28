@extends ('layouts.app')

@section('sidebar')
<div class="sidebar">
    <ul>
        <li><a href="{{ url('/admin/drinks') }}">Напитки</a>
        </li> 
    </ul>

</div>
@endsection

@section('content')
    
    <h1>Напитки</h1>
        {{print_r($drinks)}}

    <a href="{{url('/admin/createDrinks')}}">Добавить напиток</a>

@endsection