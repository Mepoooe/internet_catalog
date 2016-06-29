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
    <table class="table table-striped">
        @for ($i = 0; $i < count($drinks); $i++)
             <tr>
                @foreach ($drinks[$i] as $key => $element)
                    <td> 
                        @if ($key == 'img')
                            <img src="/tmp/cut-{{$element}}" alt="images" >
                            {{$element = null}}
                        @endif
                        {{$element}} 
                    </td>
                @endforeach
                <td>
                    <a href="{{url('/admin/updateDrinks/'.$drinks[$i]['id'].'')}}">Редактировать запись</a>
                </td>
                <td>
                    <a href="{{url('/admin/drinks/'.$drinks[$i]['id'].'')}}">Удалить запись</a>
                </td>
                
            </tr>
        @endfor 
    </table>
    <a href="{{url('/admin/createDrinks')}}">Добавить напиток</a>

@endsection