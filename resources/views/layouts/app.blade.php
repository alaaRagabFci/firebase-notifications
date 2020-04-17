<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/6.0.4/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.0.4/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.0.4/firebase-database.js"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar">
                                <a href="javascript:;" class="seenNotification dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="icon-bell"></i>
                                    Notifications
                                    <span class="badge badge-success"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <ul id="notificationList" class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283"></ul>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function() {
        // Your web app's Firebase configuration
          var firebaseConfig = {
            apiKey: "AIzaSyBngdfaqXFUkLLOuNfFjMhxdN2WbjnydxU",
            authDomain: "study-cf15c.firebaseapp.com",
            databaseURL: "https://study-cf15c.firebaseio.com",
            projectId: "study-cf15c",
            storageBucket: "study-cf15c.appspot.com",
            messagingSenderId: "393707661695",
            appId: "1:393707661695:web:af46792d8f3de1ba97924a",
            measurementId: "G-1CLYW46703"
          };
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
        const list = document.getElementById('notificationList');
        const dbRefUsers = firebase.database().ref().child('users');
        const dbRefCounter = dbRefUsers.child('{!! Auth::user()->id !!}'+ '/counter');
        const dbRefNotifications = dbRefUsers.child('{!! Auth::user()->id !!}' + '/notifications').orderByChild('id');
        dbRefNotifications.on('child_added', snap => {
            $('.noNotificationFound').hide();
            console.table(snap.val());
            $('#notificationList').prepend('<'+'li class="NotificationFound"'+'><'+'a href="'+snap.val().title+'"'+'><'+'span class="time" style="max-width: 88px;"'+'>'+snap.val().created_at+'<'+'/span'+'> <'+'span class="details"'+'><'+'span class="label label-sm label-icon label-success"'+'><'+'i class="fa fa-dot-circle-o"'+'><'+'/i'+'><'+'/span'+'>'+snap.val().description +'.' +'<'+'/span'+'><'+'/a'+'><'+'/li'+'>');
        });
        dbRefCounter.on('value', snap => {
            if(JSON.stringify(snap.val(), 0 ,3) !== 'null'){
                $('.badge').html(JSON.stringify(snap.val(), 0 ,3));
            }
            else{
                $('.badge').html(0);
                $('.NotificationFound').hide();
                $('#notificationList').append('<'+'li class="noNotificationFound"'+'><'+'a href="javascript:;"'+'><'+'span class="details"'+'><'+'span class="label label-sm label-icon label-success"'+'><'+'i class="fa fa-dot-circle-o"'+'><'+'/i'+'><'+'/span'+'>'+'لا يوجد أشعارات' +'.' +'<'+'/span'+'><'+'/a'+'><'+'/li'+'>');
            }
        });
    });
        </script>
</body>
</html>
