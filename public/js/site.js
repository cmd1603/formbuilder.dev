"use strict"
$(document).ready(function() {
    /**
     * takes in a jquery object, and makes it a droppable element that accepts
     * the passed values, and attaches the appriopriate dropHandler.
     * Basically this allows us to abstract some of the droppable logic away, and
     * attach the same active and hover classes to all of our droppable elements
     **/
	compileTemplates();	


	function makeDroppable($e, accepts, dropHandler) {
		$e.droppable( {
			activeClass: "activeDroppable",
			hoverClass: "hoverDroppable",
			greedy: true,
			accept: accepts,
			drop: dropHandler
		});
	}

	/**
	* Drop handler that will be initially attached to our main drop field
	**/

	function initialDropHandler(e, ui) {
	/**
	* create a copy of the dropped category div and set appropriate values	
	**/
		var $category = ui.draggable.clone() ;
		$category.removeClass("catField draggableField ui-draggable ui-draggable-handle");
		$category.addClass("droppedCategory");
		$category.appendTo(this);
		var i = _cat_index++;
		//$category[0].id = "CTRL-DIV-"+(i);
		
		if (globalFormObject.is_retrieving) {
			var mock_db = JSON.parse($('#mock_database').val());
			console.log("cat1", mock_db.categories[i - 1001]);
			$category[0].id = "CTRL-DIV-"+(i);
			$category.find('.ctrl-category').html(mock_db.categories[i - 1001].label);

			makeDroppable($category, '.sectField', categoryDropHandler);
			$category = {id: "CTRL-DIV-"+(i), label: mock_db.categories[i - 1001].label};

		
			
		} else {
			$category[0].id = "CTRL-DIV-"+(i);
			makeDroppable($category, '.sectField', categoryDropHandler);
			// attach our new element to where it was dropped
			// make the new category element droppable	

		}
		
		

		$(document).on('dblclick', '.droppedCategory', function(e) {
		    e.stopImmediatePropagation(); e.preventDefault(); 
            var me = $(this)
            var ctrl = me.find("[class*=ctrl]")[0];
            var ctrl_type = $.trim(ctrl.className.match("ctrl-.*")[0].split(" ")[0].split("-")[1]);
            customize_ctrl(ctrl_type, this.id);
            console.log(this.id);
        });

	}	

	/**
	* Drop handlers for section divs
	**/

	function categoryDropHandler(e, ui) {
		var $section = $(ui.draggable).clone();
		$section.removeClass("draggableField sect_click ui-draggable ui-draggable-handle elemField");
		$section.addClass("droppedSect");
		console.log(this);
		
		var i = _cat_index++;
		var y = _sect_index++;
		//populate from globalFormObject.obj - get the section info from the mock database 

		if (globalFormObject.is_retrieving) {
			var mock_db = JSON.parse($('#mock_database').val());
			// console.log("sect1", mock_database.categories[y - 2001]);
			$section[0].id = "CTRL-DIV-"+(y);
			$section.find('.ctrl-section').html(mock_db.categories[i - 1002].sections[y - 2001].label);
			// $section[0] = {id: "CTRL-DIV-"+(y), label: mock_db.categories[i - 1002].sections[y - 2001].label}

			// console.log("mock_database", mock_db);
			// $.each(mock_db.categories, function(index, cat_obj) {
			// 		console.log($(this));

			// 		var section_candidate = $(this).prop('sections');
			// 	$.each(section_candidate, function(index, sects_obj) {
			// 		console.log("db", $(this));
			// 		var sect_prop = $(this);
			// 		$.each(sect_prop, function(index, value) {

			// 			if ($(this).prop('type') == "section") {
			// 				$section[0].id = "CTRL-DIV-"+(_sect_index++);
			// 				// work_area.find('.ctrl-section').html($(this).label);			
			// 				model[$section[0].id] = {mutex: $(this).prop('mutex'), controls: [], id: $section[0].id};

			// 			}

			// 		});
															
			// 	});
				
				
			// });
		

		} else {
			$section[0].id = "CTRL-DIV-"+(y);
			model[$section[0].id] = {mutex: true, controls: []};
		}

		makeDroppable($section.find('.panel-body'), '.elemField', sectionDropHandler);
		

		$(document).on('dblclick', '.droppedSect', function(e) {
        	e.stopImmediatePropagation(); e.preventDefault();
            var me = $(this)
            var ctrl = me.find("[class*=ctrl]")[0];
            var ctrl_type = $.trim(ctrl.className.match("ctrl-.*")[0].split(" ")[0].split("-")[1]);
            customize_ctrl(ctrl_type, this.id);
            console.log(this.id);
        });

        $section.appendTo(this);
	}

	function sectionDropHandler(e, ui) {
		var $controlElement = $(ui.draggable).clone();
		$controlElement.removeClass("draggableField ui-draggable ui-draggable-handle elemField select_one_click radiogroup_click selectmultiplelist_click number_click ul_click");
		$controlElement.addClass("droppedElem");
		$controlElement[0].id = "CTRL-DIV-"+(_ctrl_index++);
		$controlElement.find("[type='radio']").attr("name", "row"+_ctrl_index.toString());

		var options = '';
		var parts = '';

		/* Assigning a unique name and id to comboboxes on drop */
		if($controlElement.children().hasClass("group1")) {
			$controlElement.find("select.group1").attr("name", "submitted_name" + name_count++).attr("id", count++);

			$controlElement.find('.group1').children().each(function(i,o) {options += o.text + '\n'});
			$controlElement.find('.group2:hidden').children().each(function(i,o) {parts += o.text + '\n'});
			var opt_pairs = {n: options,v: parts};
	    	
			// var select_one_config = {id: $controlElement[0].id, pairs: [], required_field: false, name: $controlElement.find('select.group1').attr('name')};
			// model[$(this).parent().prop('id')].controls.push(select_one_config);
			model[$controlElement[0].id] = {id: $controlElement[0].id, pairs: [], required_field: false, name: $controlElement.find('select.group1').attr('name')}
			
				if ($controlElement.first().find('.group1').find('option').length != 0) {
					$controlElement.first().find('.group1').find('option').each(function() {
						var select_one_pairs = {
							type: "pair",
							n: $(this).text(),
							v: $(this).attr("value").replace(/\(|\)/g, '')
						};
						model[$controlElement[0].id].pairs.push(select_one_pairs);
					});
					
				}	
			
		/* Assigning a unique name and id to select multiples on drop */	
		} else if ($controlElement.children().children().hasClass("group3")) {
			$controlElement.find("select.group3").attr("name", "submitted_multiple" + name_count_mult++).attr("id", "select" + count2++);
			model[$controlElement[0].id] = {required_field: false, name: $controlElement.find('select.group3').prop('name')};
		/* Assigning a unique name and id to number types on drop */

		} else if ($controlElement.children().hasClass("number_group")) {
			$controlElement.find('.ctrl-number').attr("name", "submitted_number" + number_name_count++).attr("id", "number_id_" + number_count++);
			model[$controlElement[0].id] = {required_field: false, name: $controlElement.find('.ctrl-number').prop('name')};

		} else if ($controlElement.children().hasClass('ctrl-radiogroup')) {
			$controlElement.attr('name', "radio_" + radio_count++);
			model[$controlElement[0].id] = {type: "ctrl-ron", required_field: false, name: $controlElement.attr('name')};

		} else if ($controlElement.children().hasClass('ctrl-unordered_list')) {
			$controlElement.attr('name', "text_" + text_count++);
			model[$controlElement[0].id] = {required_field: false, name: $controlElement.attr('name')};
		}
		

		var $radiosInSection = $controlElement.find("[type='radio']");
		var item = $(this).find('.ctrl-section');		
		
		$radiosInSection.each(function() {
			var $radio = $(this);
			$radio.attr("name", ($(item).text().replace(/\s/g,'')) + "__"  + (_ctrl_index.toString() - 3002));
		});

		console.log("model", model);
		$controlElement.appendTo(this);
		/* After dropping the control, attach the customization tool */
        
        $(document).on('dblclick', '.droppedElem', function(e) {
        	e.stopImmediatePropagation(); e.preventDefault();
            var me = $(this)
            var ctrl = me.find("[class*=ctrl]")[0];
            var ctrl_type = $.trim(ctrl.className.match("ctrl-.*")[0].split(" ")[0].split("-")[1]);
            customize_ctrl(ctrl_type, this.id);
            console.log(this.id);
        });

		$('.droppedSect').find('.panel-body').sortable({
	    	connectWith: ($('.droppedSect').find('.panel-body'))
	    });
		
        
	}

		
	/**
	* variables to keep track of ids for generated elements
	**/
	var _cat_index = 1001;
	var _sect_index = 2001;
	var _ctrl_index = 3001;

	var name_count = 1;
	var name_count_mult = 1;
	var count = 1;
	var count2 = 1;
	var number_count = 1;
	var number_name_count = 1;
	var radio_count = 1;
	var text_count = 1;
	/**
	* initialize the draggable elements
	**/

	$(".selectorField").draggable({ 
		helper: "clone", 
		stack: "div", 
		cursor: "move",
		appendTo: 'body',
		revert: "invalid",
		cancel: null  
	});	


    /**
     * initialize the droppable fields
     **/

	makeDroppable($('.droppedFields'), '.catField', initialDropHandler);


	    $( ".droppedFields" ).sortable({
	    	helper: 'clone',
            cancel: null, // Cancel the default events on the controls	    	
	    	connectWith: ".droppedFields"
	    }).disableSelection();


	/* JS FOR SIDEBAR FIXED POSITION SCROLLING */
	$('#sidebar').affix({
	  offset: {
	    top: 30
	  }
	});


});

