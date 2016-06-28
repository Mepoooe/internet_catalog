@extends ('layouts.app')



@section('content')
    
    <h1>Админка</h1>
        @section('sidebar')
            <div class="sidebar">
                <ul>
                    <li><a href="{{ url('/admin/drinks') }}">Напитки</a>
                    </li> 
                </ul>

            </div>
        @endsection

@endsection