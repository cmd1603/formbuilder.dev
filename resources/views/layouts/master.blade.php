<!DOCTYPE html>
<html>
	<head>
		<title>Quote and Order Builder</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
		<script src="https://rawgit.com/jquery/jquery-ui/1-11-stable/external/jquery-simulate/jquery.simulate.js"></script>
		<script src="http://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
		<script type="text/javascript" src="/js/jquery-simulate-ext-master/libs/bililiteRange.js"></script>
		<script type="text/javascript" src="/js/jquery-simulate-ext-master/libs/jquery.simulate.js"></script>
		<script type="text/javascript" src="/js/jquery-simulate-ext-master/src/jquery.simulate.ext.js"></script>
		<script type="text/javascript" src="/js/jquery-simulate-ext-master/src/jquery.simulate.drag-n-drop.js"></script>
		<script type="text/javascript" src="/js/jquery-simulate-ext-master/src/jquery.simulate.key-sequence.js"></script>
		<script type="text/javascript" src="/js/jquery-simulate-ext-master/src/jquery.simulate.key-combo.js"></script>	
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
	    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">		
		<link rel="stylesheet" type="text/css" href="/css/site.css">
		<style id="content-styles">
		
			.droppedElem {
				padding-left: 10px;
			}
			.form-horizontal .control-label {
			    float: left;
			    width: 160px;
			    padding-right: 5px;
			    text-align: right;
			}

			.form-horizontal .control-section {
			    float: left;
			    width: 160px;
			    padding-right: 5px;
			    text-align: right;
			}

			.control-label; {
			    padding-top: 5px;
			    vertical-align: baseline;
			    padding-right: 10px;
			}

			.decreaseSectPadding {
				padding: 1px 15px;
			}

			.droppedField, .droppedSect > input, select, button, .ctrl-textbox, .checkboxgroup, .selectmultiplelist, .radiogroup {
				margin-top: 10px;
				margin-bottom: 10px;
				margin-right: 10px;
			}

			.ctrl-select_one {
				width: 99%;
			}

			.panel {
				margin-bottom: 10px;
			}
			.pb-sect {
				padding: 0px;
			}

			.panel-body {
				padding: 8px;
			}

		</style>
	</head>	
	<body>
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
                    <li><a href="{{ url('/') }}" class="nav_buttons">Home</a></li>
                    @elseif (Auth::user()->name == "Sales")
                    <li><a href="{{ url('/') }}" class="nav_buttons">Home</a></li>
                    <li><a href="{{ url('productaccess') }}" class="nav_buttons">Access</a></li>
                    @else
                    <li><a href="{{ url('/') }}" class="nav_buttons">Home</a></li>
                    <li><a href="{{ url('configurations') }}">Configurations</a></li>
                    <li><a href="{{ url('rules') }}" class="nav_buttons">Rules</a></li>
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
	                        <li><a href="{{ url('/login') }}" class="nav_buttons">Login</a></li>
	                    @else
	                    	<li><a href="{{ action('UserController@show', Auth::user()->id) }}" class="nav_buttons">My Profile</a></li>                 
	                        <li class="dropdown">
	                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" class="nav_buttons">
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
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>	
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/1.0.0-rc.3/handlebars.min.js"></script>
	<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/modernizr-2.7.1.js"></script>
	</body>
</html>
