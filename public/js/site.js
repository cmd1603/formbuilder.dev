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
		var $category = ui.draggable.clone();
		$category.removeClass("catField draggableField ui-draggable ui-draggable-handle");
		$category.addClass("droppedCategory");
		$category.appendTo(this);

		if (globalFormObject.is_retrieving) {
			$category[0].id = "CTRL-DIV-"+(_cat_index);
			// console.log(_cat_index);
			$category.find('.ctrl-category').html(globalFormObject.obj.categories[_cat_index - 1001].label);
			makeDroppable($category.find(".category-body"), '.sectField', categoryDropHandler);
			// console.log("cat1", globalFormObject.obj.categories[(_cat_index - 1001)]);
			model[$category[0].id] = {
								id: "CTRL-DIV-"+(_cat_index),
								label: globalFormObject.obj.categories[_cat_index - 1001].label,
								sections: []
							};
			_cat_index++;
			globalFormObject.cat_index++;
			
		} else {
			$category[0].id = "CTRL-DIV-"+(_cat_index++);

			// attach our new element to where it was dropped
			// make the new category element droppable	
			makeDroppable($category.find(".category-body"), '.sectField', categoryDropHandler);	
		}
		
		$(document).on('dblclick', '.droppedCategory', function(e) {
		    e.stopImmediatePropagation(); e.preventDefault(); 
            var me = $(this);
            var ctrl = me.find("[class*=ctrl]")[0];
            var ctrl_type = $.trim(ctrl.className.match("ctrl-.*")[0].split(" ")[0].split("-")[1]);
            customize_ctrl(ctrl_type, this.id);
            console.log(this.id);
        });
	}	

	/**
	* Drop handlers for category and section divs
	**/

	function categoryDropHandler(e, ui) {
		var $section = $(ui.draggable).clone();
		$section.removeClass("draggableField sect_click ui-draggable ui-draggable-handle sectField elemField");
		$section.addClass("droppedSect");
		$section.appendTo(this);
		
		if (globalFormObject.is_retrieving) {
			var my_section = globalFormObject.obj.categories[_cat_index - 1002].sections[globalFormObject.sect_index];
			$section[0].id = "CTRL-DIV-"+(_sect_index);
			$section.find('.ctrl-section').html(my_section.label);

			makeDroppable($section.find('.section-body'), '.elemField', sectionDropHandler);
			// console.log(globalFormObject.sect_index);
				
			model[$section[0].id] = {
								id: "CTRL-DIV-"+(_sect_index), 
								label: my_section.label, 
								mutex: my_section.mutex,
								one_required: my_section.one_required,
								hide_children: my_section.hide_children
							};

			if(my_section.one_required == true) {
				$section.addClass('require_one');
			} else {
				$section.removeClass('require_one');
			}

			function timeout() {
			    if(my_section.hide_children == true) {
			    	$section.find('.section-body').children().hide();
			    } else {
			    	$section.find('.section-body').children().show();
			    }				
			}
			setTimeout(timeout, 500);


			_sect_index++;
			globalFormObject.sect_index++;

		} else {
			$section[0].id = "CTRL-DIV-"+(_sect_index++);
			model[$section[0].id] = {mutex: true, one_required: false, hide_children: false, controls: []};
			makeDroppable($section.find('.section-body'), '.elemField', sectionDropHandler);
		}

		$(document).on('dblclick', '.droppedSect', function(e) {
        	e.stopImmediatePropagation(); e.preventDefault();
            var me = $(this);
            var ctrl = me.find("[class*=ctrl]")[0];
            var ctrl_type = $.trim(ctrl.className.match("ctrl-.*")[0].split(" ")[0].split("-")[1]);
            customize_ctrl(ctrl_type, this.id);
            console.log(this.id);
        });
        
        $(".droppedCategory").find(".category-body").sortable({
            connectWith: ($(".droppedCategory").find(".category-body"))
        });  

	}

	function sectionDropHandler(e, ui) {
		var $controlElement = $(ui.draggable).clone();
		$controlElement.removeClass("draggableField ui-draggable ui-draggable-handle elemField select_one_click radiogroup_click selectmultiplelist_click number_click ul_click btn_click");
		$controlElement.addClass("droppedElem");

		if (globalFormObject.is_retrieving) {
			var my_control = globalFormObject.obj.categories[_cat_index - 1002].sections[globalFormObject.sect_index - 1].controls[globalFormObject.control_index];
			if($controlElement.children().hasClass("group1")) {

				$controlElement[0].id = "CTRL-DIV-"+(_ctrl_index);
				//$controlElement.find("select.group1").attr("name", "submitted_name_" + name_count++).attr("id", count++);
				$controlElement.find('select.group1').attr('name', my_control.name);
				$controlElement.find('.optional_label').html(my_control.label);
				
				model[$controlElement[0].id] = {
										name: my_control.name,
										label: my_control.label,
										id: "CTRL-DIV-"+(_ctrl_index),
										required_field: my_control.required_field,
										pairs: []		
								};
				
				var options = '';
				var parts = '';

				var div_ctrl = $controlElement;
				var ctrl = div_ctrl.find('select')[0];

				$.each(my_control.pairs, function(index, value) {
					options += $(this).prop('n') + "\n";
					parts += $(this).prop('v') + "\n";
				});
				
				$(ctrl).empty();

				$(options.split('\n')).each(function(i,o) {
					$(ctrl).append("<option>" + $.trim(o) + "</option>");
				});

				$(ctrl).parent().find("select.group2").empty();

				$(parts.split('\n')).each(function(i,o) {
					$(ctrl).parent().find("select.group2").append("<option>" + $.trim(o) + "</option>");
				});

				var partsObject = $(parts.split('\n'));

				var partsArray = $.map(partsObject, function(value, index) {
					return [value];
				});

				$controlElement.find("select.group1").attr("id", "select" + "_" + count++);

				var $individualOption = div_ctrl.find("option");        
				var optionCount = 0;  
		    	$individualOption.each(function() {
		   	  
			      	if ($(this).parent().is(".group1")) {	      
				      $(this).attr('class', 'generatedOptions');
					  $(this).attr('value', partsArray[optionCount]);
			      	}       
					optionCount++;	
			    });
		

				$(ctrl).parent().find('.group1 option').each(function() {
					if ($(this).text() == "") {
						$(this).remove();
					}
				});

				if(my_control.required_field == true) {
					$controlElement.find('.group1').addClass('required');
				} else {
					$controlElement.find('.group1').removeClass('required');
				}
			
				_ctrl_index++;
				globalFormObject.control_index++;

			} else if ($controlElement.children().hasClass('ctrl-radiogroup')) {
				$controlElement[0].id = "CTRL-DIV-"+(_ctrl_index);
				$controlElement.find('.makeBold').html(my_control.label);


				$controlElement.find('.required_radio').attr('name', my_control.pairs[0].n);
				$controlElement.find('.required_radio').attr('value', "r" + my_control.pairs[0].v);

				$controlElement.find('.optional_radio').attr('name', my_control.pairs[0].n);
				$controlElement.find('.optional_radio').attr('value', "o" + my_control.pairs[0].v);

				$controlElement.find('.na_radio').attr('name', my_control.pairs[0].n);
				$controlElement.find('.na_radio').attr('value', "n" + my_control.pairs[0].v);

				$controlElement.find('.placeHolderClass').attr('name', my_control.pairs[0].n);
				$controlElement.find('.placeHolderClass').attr('value', my_control.pairs[0].v);

				 model[$controlElement[0].id] = {
				// 						name: my_control.name,
				// 						label: my_control.label,
				// 						id: "CTRL-DIV-"+(_ctrl_index),
				 						required_field: my_control.required_field,
				 						required_only: my_control.required_only,
				 						hide_optional: my_control.hide_optional
				// 						pairs: []		
				 				};

			    if(my_control.required_field == true) {
		    		$controlElement.find('.na_radio').attr('checked', false);
		    		$controlElement.find('.required_radio').attr('checked', true);
			    } else {
			    	$controlElement.find('.na_radio').attr('checked', true);
			    	$controlElement.find('.required_radio').attr('checked', false);		    	
			    }			


			    if(my_control.required_only == true) {
		    		$controlElement.find(".optionField").hide();
		    		$controlElement.find(".naField").hide();
			    } else if(my_control.hide_optional == true) {
			    	$controlElement.find(".optionField").hide();
			    	$controlElement.find(".naField").show();
			    } else {
			    	$controlElement.find(".optionField").show();
			    	$controlElement.find(".naField").show();	    	
			    }
				_ctrl_index++;
				globalFormObject.control_index++;

			} else if($controlElement.children().children().hasClass('group3')) {
				$controlElement[0].id = "CTRL-DIV-"+(_ctrl_index);
				$controlElement.find("select.group3").attr("name", "submitted_multiple" + name_count_mult).attr("id", "select" + count2);
				$controlElement.find('.optional_label_mult').html(my_control.label);
				
				model[$controlElement[0].id] = {
										name: my_control.name,
										label: my_control.label,
										id: "CTRL-DIV-"+(_ctrl_index),
										required_field: my_control.required_field,
										pairs: []		
								};

				var options = '';
				var parts = '';

				var div_ctrl = $controlElement;
				var ctrl = div_ctrl.find('select')[0];

				$.each(my_control.pairs, function(index, value) {
					options += $(this).prop('n') + "\n";
					parts += $(this).prop('v') + "\n";
				});
				
				$(ctrl).empty();

				$(options.split('\n')).each(function(i,o) {
					$(ctrl).parent().find("select.group3").append("<option>" + $.trim(o) + "</option>");
				});

				$(ctrl).parent().find("select.group4").empty();

				$(parts.split('\n')).each(function(i,o) {
					$(ctrl).parent().find("select.group4").append("<option>" + $.trim(o) + "</option>");
				});

				var partsObject = $(parts.split('\n'));

				var partsArray = $.map(partsObject, function(value, index) {
					return [value];
				});

				$controlElement.find("select.group3").attr("id", "select" + count2++);

		    	var $individualOption = div_ctrl.find("option");        
				var optionCount = 0;  
		    	$individualOption.each(function() {
		   	  
			      	if ($(this).parent().is(".group3")) {	      
				      $(this).attr('class', 'generatedOptions');
					  $(this).attr('value', partsArray[optionCount]);
			      	}       
					optionCount++;	
			    });

		      	$(ctrl).parent().find('.group3 option').each(function() {
							if ($(this).text() == "") {
								$(this).remove();
							}
				});
				
				_ctrl_index++;
				globalFormObject.control_index++;

			} else if($controlElement.children().hasClass('number_group')) {
				$controlElement[0].id = "CTRL-DIV-"+(_ctrl_index);
				$controlElement.find('.number_option').html(my_control.label);
				$controlElement.find('.ctrl-number').attr('name', my_control.name);
				$controlElement.find('.ctrl-number').attr('value', my_control.default);
				$controlElement.find('.ctrl-number').attr('min', my_control.min);
				$controlElement.find('.ctrl-number').attr('max', my_control.max);
				$controlElement.find('.ctrl-number').attr('step', my_control.step);

				model[$controlElement[0].id] = {
										required_field: my_control.required_field
								};

				_ctrl_index++;
				globalFormObject.control_index++;

			} else if($controlElement.children().hasClass('ctrl-unordered_list')) {
				$controlElement[0].id = "CTRL-DIV-"+(_ctrl_index);
				$controlElement.find('.ul_txt').html(my_control.label);
				model[$controlElement[0].id] = {
										required_field: my_control.required_field
								};
				_ctrl_index++;
				globalFormObject.control_index++;			

			} else if($controlElement.children().hasClass('ctrl-button')) {
				$controlElement[0].id = "CTRL-DIV-"+(_ctrl_index);
				$controlElement.find('a').html(my_control.label);
				$controlElement.find('a').attr('href', my_control.url);
				$controlElement.find('a').attr('class', my_control.class);
				_ctrl_index++;
				globalFormObject.control_index++;				
			}

		} else {

				if($controlElement.children().hasClass("group1")) {

					$controlElement[0].id = "CTRL-DIV-"+(_ctrl_index++);
					
					$controlElement.find("[type='radio']").attr("name", "row"+_ctrl_index.toString());

					var options = '';
					var parts = '';

					/* Assigning a unique name and id to comboboxes on drop */
						$controlElement.find("select.group1").attr("name", "submitted_name_" + name_count++).attr("id", "select" + "_" + count++);
						$controlElement.find('.group1').children().each(function(i,o) {options += o.text + '\n'});
						$controlElement.find('.group2:hidden').children().each(function(i,o) {parts += o.text + '\n'});
				    	model[$controlElement[0].id] = {id: $controlElement[0].id, pairs: [], required_field: false, name: $controlElement.find('select.group1').attr('name')};
						
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
					$controlElement[0].id = "CTRL-DIV-"+(_ctrl_index++);
					$controlElement.find("select.group3").attr("name", "submitted_multiple" + name_count_mult++).attr("id", "select" + count2++);
					model[$controlElement[0].id] = {required_field: false, name: $controlElement.find('select.group3').prop('name')};
				/* Assigning a unique name and id to number types on drop */

				} else if ($controlElement.children().hasClass("number_group")) {
					$controlElement[0].id = "CTRL-DIV-"+(_ctrl_index++);
					$controlElement.find('.ctrl-number').attr("name", "submitted_number" + number_name_count++).attr("id", "number_id_" + number_count++);
					model[$controlElement[0].id] = {required_field: false, name: $controlElement.find('.ctrl-number').prop('name')};

				} else if ($controlElement.children().hasClass('ctrl-radiogroup')) {
					$controlElement[0].id = "CTRL-DIV-"+(_ctrl_index++);
					$controlElement.attr('name', "radio_" + radio_count++);
					model[$controlElement[0].id] = {type: "ctrl-ron", required_field: false, required_only: false, hide_optional: false, name: $controlElement.attr('name')};

				} else if ($controlElement.children().hasClass('ctrl-unordered_list')) {
					$controlElement[0].id = "CTRL-DIV-"+(_ctrl_index++);
					$controlElement.attr('name', "text_" + text_count++);
					model[$controlElement[0].id] = {required_field: false, name: $controlElement.attr('name')};

				} else if ($controlElement.children().hasClass('ctrl-button')) {
					$controlElement[0].id = "CTRL-DIV-"+(_ctrl_index++);
					$controlElement.attr('name', "button_" + button_count++);
					model[$controlElement[0].id] = {required_field: false, label: $controlElement.find('a').text()};
				}

		}
	
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

	var name_count = 1;
	var name_count_mult = 1;
	var count = 1;
	var count2 = 1;
	var number_count = 1;
	var number_name_count = 1;
	var radio_count = 1;
	var text_count = 1;
	var button_count = 1;
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

