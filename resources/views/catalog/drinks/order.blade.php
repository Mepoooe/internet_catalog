@extends ('layouts.app')

@section('content')

  <div class="row">
    <div class="col-md-8">
          <div class="jumbotron">
            <h2 class="orderHeader">Оформление заказа</h2>
              <div class="container">
                @if(!empty($errors->all()))
                  <table class="table table-condensed">
                      
                      @foreach ($errors->all() as $error)
                      <tr>
                          <td class="danger">{{ $error }}</td>
                      </tr>
                      @endforeach
                  </table>
                @endif
                  <form class="form-horizontal" method="post" action="/catalog/drinks/drinksOrder">
                      <div class="form-group">
                          <label for="inputEmail3" id="orderId1">Ваше имя</label>
                         <input type="text" id="orderId1" class="form-control" placeholder="Имя" name="name">
                      </div>
                      <div class="form-group">
                          <label for="inputEmail3" id="orderId2">Ваш email</label>
                         <input type="text" id="orderId2" class="form-control" placeholder="email" name="email">
                      </div>
                      <div class="form-group">
                         <label for="inputEmail3" id="orderId3">Ваш номер</label>
                         <input type="text" id="orderId3" class="form-control" placeholder="Номер" name="phone">
                      </div>
                      {{csrf_field()}}
                       <button type="submit" class="btn btn-success orderButton">Подтвердить заказ</button>
                  </form>
              </div>
          </div>
    </div>
    <div class="col-md-4">
      <div class="right_coll">
          <h2 ">Вы оформляете:</h2>
            <div class="row">
              <div class="col-md-4">
                <img lass="img-rounded" src="/tmp/cut-{{$drinks['drinksImg']}}" alt="товар">
              </div>
              <div class="col-md-4 phoneNameOrder">
                <p><h4>{{$drinks['drinksName']}}</h4><p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <p class="summaOrder"> Сумма: {{$drinks['drinksPrice']}}</p>
              </div>
            </div>
        </div>
    </div>
  </div>

@endsection
