<!DOCTYPE html>
<html>
	<head>
		<title>Quote and Order Builder</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">	
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

			.ctrl-combobox {
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

			body {
				width: 90%;
			}
		</style>
	</head>	
	<body>

	@yield('content')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>	
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/1.0.0-rc.3/handlebars.min.js"></script>
	<script src="https://cdn.rawgit.com/blowsie/Pure-JavaScript-HTML5-Parser/master/htmlparser.js"></script>
	<script type="text/javascript" src="/js/html2json-master/src/html2json.js"></script>
	@include('partials.handlebars_template')
	<script type="text/javascript" src="/js/site.js"></script>
	</body>
</html>
