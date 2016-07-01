@extends('layouts.app')
<!-- все что в section с соответ именем будет переданно в yeat --> 
@section('content')
<div class="container">

      <!-- The justified navigation menu is meant for single line per list item.
           Multiple lines will require custom code not provided by Bootstrap. -->
    
    @include('layouts/nav')
      <!-- Jumbotron -->
      <div class="jumbotron">
            <h1>Добро пожаловать</h1>
          <h2>Над этим проектом работате команда team-burzum!</h3>
          <ul class="list-group">
              <li class="list-group-item" >Первое правило team-burzum: добро пожаловать в team-burzum.</li>
              <li class="list-group-item" >Второе правило team-burzum: никогда никому не рассказывать о team-burzum.</li>
              <li class="list-group-item" >Третье правило team-burzum: в схватке участвуют только двое.</li>
              <li class="list-group-item" >Четвертое правило team-burzum: не более одного сайта за один раз.</li>
              <li class="list-group-item" >Пятое правило team-burzum: php-разработчики программируют без обуви и голые по пояс.</li>
              <li class="list-group-item" >Шестое правило team-burzum: разработка продолжается столько, сколько потребуется</li>
              <li class="list-group-item" >Седьмое правило team-burzum : если заказчик потерял сознание или делает вид, что потерял, или говорит «Хватит» — заказ выполнен.</li>
              <li class="list-group-item" >
Восьмое и последнее правило team-burzum : новичок обязан учавствовать в разработке.</li>
          </ul>

          

</p>
          <p><a class="btn btn-primary btn-lg" role="button">Узнать больше</a></p>
      </div>

      <!-- Example row of columns -->
      <div class="row">
        <div class="col-lg-4">
          <h2>Safari bug warning!</h2>
          <p class="text-danger">As of v8.0, Safari exhibits a bug in which resizing your browser horizontally causes rendering errors in the justified nav that are cleared upon refreshing.</p>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-primary" href="#" role="button">View details »</a></p>
        </div>
        <div class="col-lg-4">
          <h2>Heading</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-primary" href="#" role="button">View details »</a></p>
       </div>
        <div class="col-lg-4">
          <h2>Heading</h2>
          <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p>
          <p><a class="btn btn-primary" href="#" role="button">View details »</a></p>
        </div>
      </div>

      <!-- Site footer -->
      <footer class="footer">
        <p>© 2016 Company team-burzum  Inc.</p>
      </footer>

    </div>
<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
@endsection
