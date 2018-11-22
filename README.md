# web
web projects
<h2> <a href="https://github.com/mikenmsl/web/tree/master/vueProject/IPS" >SPA - приложение vue.js</a></h2>
 <h4><a href="http://zotov.mcdir.ru/index.html">Протестировать приложение</a></h4>
 <p><b> 
 SPA - приложение (vue.js) для работы с ресурсами для парсинга и сохранения/обновления нужной информации <code>(vue, php, axios)</code>.
 </b></p>
 <details>
<summary>описание</summary>
 <p><b> 
 SPA - приложение (vue.js) для работы с ресурсами для парсинга и сохранения/обновления нужной информации <code>(vue, php, axios)</code>.
 </b></p>
 <p>Для обращения к базе данных на сервере, созданы api функции на языке php, к которым обращаемся POST запросами (axios).
 При запуске приложения открывается таблица источников, каждый источник имеет свои ссылки (url) по которым и осуществляется парсинг и сохранение информации.</br>
Парсинг данных осуществляется на сервере с помощью библиотеки simple_html_dom.php</p>
 <ul><b>Опции: </b>
 <li>Смена цветовой схемы (доступна светлая и темная, которая стоит по умолчанию)</li>
 <li>Сортировка таблицы источников по любому столбцу (в прямом и обратном направлении)</li>
 <li>Расширенный поиск в таблице источников по любым полям</li>
 <li>Создание, удаление и редактирование таблиц</li>
 <li>Гибкий парсинг информации</li>
 <li><details>
<summary>схема БД (нажать)</summary>
  <p><img src="http://i.mcgl.ru/HoRD9D6wjJ" alt=""></p>
</details></li>
</ul>
 <ul><b>Компоненты: </b>
  <li> <a href="https://github.com/mikenmsl/web/blob/master/vueProject/IPS/src/App.vue" >App.vue </a> -	родитель </li>
 <li> <a href="https://github.com/mikenmsl/web/blob/master/vueProject/IPS/src/components/MainTableScreen.vue" >MainTableScreen.vue </a> -	интерфейс для работы с таблицей ресурсов</li>
        <li> <a href="https://github.com/mikenmsl/web/blob/master/vueProject/IPS/src/components/SourceTableScreen.vue" >SourceTableScreen.vue </a> -	интерфейс для работы с таблицей ссылкой (url)</li>
 <li> <a href="https://github.com/mikenmsl/web/blob/master/vueProject/IPS/src/components/ViewDate.vue" >ViewDate.vue </a> -	интерфейс для работы с данными и парсингом информации</li>
 <li> <a href="https://github.com/mikenmsl/web/blob/master/vueProject/IPS/ajax.php" >ajax.php </a> -	API функции для работы с базой данных </li>
 <li> <a href="https://github.com/mikenmsl/web/blob/master/vueProject/IPS/src/main.js" >main.js </a> -	регистрация компонентов vue</li>
    </ul>
    </details>
<div>
 <div>
 <h2>
        <a href="https://github.com/mikenmsl/web/tree/master/vueProject/coach" >coach (vue.js)</a>
    </h2>
  <h4><a href="http://zotov.mcdir.ru/coach/index.html">Протестировать приложение</a></h4>
  <p><b> 
 Математический тренажер, с возможностью тренировки сложения и умножения.
 </b></p>
   <details>
<summary>описание</summary>
<p><b> 
 Математический тренажер, с возможностью тренировки сложения и умножения.
 </b></p>
  
 <ul><b>Компоненты: </b>
  <li> <a href="https://github.com/mikenmsl/web/blob/master/vueProject/coach/src/App.vue" >App </a> -	родитель </li>
 <li> <a href="https://github.com/mikenmsl/web/blob/master/vueProject/coach/src/components/Message.vue" >Message </a> -	отвечает за сообщения результата решения примера</li>
        <li> <a href="https://github.com/mikenmsl/web/blob/master/vueProject/coach/src/components/Question.vue" >Question </a> -	генерация и вывод примера</li>
 <li> <a href="https://github.com/mikenmsl/web/blob/master/vueProject/coach/src/components/ResultScreen.vue" >ResultScreen </a> -	результат прохождения уровня</li>
 <li> <a href="https://github.com/mikenmsl/web/blob/master/vueProject/coach/src/components/StartScreen.vue" >StartScreen </a> -	стартовый экран, приветствие и выбор режима</li>
    </ul>
    
</details>

 <h2>
        <a  >Верстка сайта Unique</a>
    </h2>
  <h4><a href="http://zotov.mcdir.ru/site/unique/index.html">demo</a></h4>
  
   <details>
<summary>шаблон (jpeg)</summary> 
  <p><img src="http://i.mcgl.ru/ZYJ2uttp8Y" alt=""></p>
</details>
  
   <h2>
        <a " >Верстка сайта ZET</a>
    </h2>
  <h4><a href="http://zotov.mcdir.ru/site/zet/index.html">demo</a></h4>
  
   <details>
<summary>шаблон (jpeg)</summary> 
  <p><img src="http://i.mcgl.ru/gqQ7m6o0jP" alt=""></p>
</details>

<h2>
        <a href="https://github.com/mikenmsl/web/blob/master/pars-proxy.py" >pars-proxy (python) </a>
    </h2>
<p><b> 
Парсинг IP адресов и портов с сайта, предоставляющий список открытых прокси. Скрипт обходит защиту <a href="https://www.cloudflare.com">CloudFlare </a> и импортирует данные в файл в виде <i>ip:port</i>
 </b></p>
 
 <p>
    
