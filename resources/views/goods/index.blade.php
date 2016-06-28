@extends ('layouts.app')

@section('content')
    
    <h1>Товары</h1>
        @foreach($goods->toArray() as $good) {
            {{$good}}
        }
        @endforeach
@endsection