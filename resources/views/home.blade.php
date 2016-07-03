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
          
      </div>

     
      <!-- Site footer -->
      <footer class="footer">
        <p>© 2016 Company team-burzum  Inc.</p>
      </footer>

    </div>
<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
@endsection
