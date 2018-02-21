<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    
    <title>Multicam, Inc - Ouote and Order Builder</title>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://rawgit.com/jquery/jquery-ui/1-11-stable/external/jquery-simulate/jquery.simulate.js"></script>
    <script src="http://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/css/dev.css">
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top" style="margin-bottom: 0px">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    @if (Auth:: guest())
                    <li><a href="{{ url('/') }}">Home</a></li>
                    @elseif (Auth::user()->name == "Sales")
                    <li><a href="{{ url('/') }}" class="nav_buttons">Home</a></li>
                    <li><a href="{{ url('productaccess') }}" class="nav_buttons">Access</a></li>         
                    @else
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('configurations') }}">Configurations</a></li>
                    <li><a href="{{ url('rules') }}">Rules</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Access <span class="caret"></span>
                        </a>                        
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('productaccess') }}" class="nav_buttons"><i class="fa fa-btn fa-sign-out"></i>Access Home</a></li>
                            <li><a href="{{ url('sfpc_access') }}" class="nav_buttons"><i class="fa fa-btn fa-sign-out"></i>SFPC Access</a></li>
                            <li><a href="{{ url('productaccess/create') }}"><i class="fa fa-btn fa-sign-out"></i>Distributor Access</a></li>
                        </ul>   
                    </li>   
                    <li><a href="{{ url('sales_people') }}" class="nav_buttons">Salesperson</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Create <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('creater') }}"><i class="fa fa-btn fa fa-sign-out"></i>Create Home</a></li>
                            <li><a href="{{ url('configurations/create') }}"><i class="fa fa-btn fa fa-sign-out"></i>Configuration</a></li>
                            <li><a href="{{ url('rule_ids/create') }}"><i class="fa fa-btn fa-sign-out"></i>Rule</a></li>
                            <li><a href="{{ url('productaccess/create') }}"><i class="fa fa-btn fa-sign-out"></i>Product Access</a></li>
                            <li><a href="{{ url('sales_people/create') }}"><i class="fa fa-btn fa-sign-out"></i>Salesperson</a></li>
                        </ul>
                    </li>
<!--                     <li><a href="{{ url('cutting_technologies') }}">Cutting Technologies</a></li> -->
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    @else
                    <li><a href="{{ action('UserController@show', Auth::user()->id) }}">My Profile</a></li>                   
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('dashboard') }}"><i class="fa fa-btn fa fa-sign-out"></i>Dashboard</a></li>
                            <li><a href="{{ url('logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>
