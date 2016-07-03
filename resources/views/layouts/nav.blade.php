     <div class="masthead">
            <h3 class="text-muted red" >Каталог</h3>
            <nav>
              <ul class="nav nav-tabs">
              <li
              @if ($_SERVER['REQUEST_URI'] == '/catalog')
                 class="active"
              @endif
              ><a href="/catalog">Home</a></li>
              <li
              @if ($_SERVER['REQUEST_URI'] == '/catalog/drinks')
                class="active"
              @endif
                ><a href="/catalog/drinks">Напитки</a></li>
                <li><a href="#">Электротовары</a></li>
                <li
                @if ($_SERVER['REQUEST_URI'] == '/catalog/phones')
                class="active"
              @endif
              ><a href="/catalog/phones">Телефоны</a></li>
                <li><a href="#">тест</a></li>
                <li><a href="#">О нас</a></li>
              </ul>
            </nav>
     </div>