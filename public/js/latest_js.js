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

	var section_index;
	var control_index;
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
			makeDroppable($category, '.sectField', categoryDropHandler);
			console.log("cat1", globalFormObject.obj.categories[(_cat_index - 1001)]);
			model[$category[0].id] = {
								id: "CTRL-DIV-"+(_cat_index),
								label: globalFormObject.obj.categories[_cat_index - 1001].label,
								sections: []
							};
			_cat_index++;
			globalFormObject.cat_index++;
			
		} else {
			$category[0].id = "CTRL-DIV-"+(_cat_index);
			 model[$category[0].id] = {id: "CTRL-DIV-"+(_cat_index), sections: []};
			 section_index = 0;
			 console.log(section_index);
			_cat_index++;				
			makeDroppable($category, '.sectField', categoryDropHandler);
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
		$section.removeClass("draggableField sect_click ui-draggable ui-draggable-handle elemField");
		$section.addClass("droppedSect");
		$section.appendTo(this);
		
		//populate from globalFormObject.obj - get the section info from the mock database 
		
		if (globalFormObject.is_retrieving) {
			$section[0].id = "CTRL-DIV-"+(_sect_index);
			$section.find('.ctrl-section').html(globalFormObject.obj.categories[_cat_index - 1002].sections[globalFormObject.sect_index].label);

			makeDroppable($section.find('.panel-body'), '.elemField', sectionDropHandler);
			console.log(globalFormObject.sect_index);
				
			model[$section[0].id] = {
								id: "CTRL-DIV-"+(_sect_index), 
								label: globalFormObject.obj.categories[_cat_index - 1002].sections[globalFormObject.sect_index].label, 
								mutex: globalFormObject.obj.categories[_cat_index - 1002].sections[globalFormObject.sect_index].mutex
							};

			// $section[0].id = "CTRL-DIV-"+(_sect_index);

			// var section_config = {id: "CTRL-DIV-"+(_sect_index), mutex: true, controls: []};

			// model[$section.parent().prop('id')].sections.push(section_config);

			// makeDroppable($section.find('.panel-body'), '.elemField', sectionDropHandler);
			// _sect_index++	

			_sect_index++;
			globalFormObject.sect_index++;

		} else {
			$section[0].id = "CTRL-DIV-"+(_sect_index);
			var section_config = {id: "CTRL-DIV-"+(_sect_index), mutex: true, controls: []};
			console.log($section.parent().prop('id'));
			model[$section.parent().prop('id')].sections.push(section_config);
			_sect_index++;
			section_index++;
			console.log(section_index);
			makeDroppable($section.find('.panel-body'), '.elemField', sectionDropHandler);
		}

		$(document).on('dblclick', '.droppedSect', function(e) {
        	e.stopImmediatePropagation(); e.preventDefault();
            var me = $(this)
            var ctrl = me.find("[class*=ctrl]")[0];
            var ctrl_type = $.trim(ctrl.className.match("ctrl-.*")[0].split(" ")[0].split("-")[1]);
            customize_ctrl(ctrl_type, this.id);
            console.log(this.id);
        });
	}

	function sectionDropHandler(e, ui) {
		var $controlElement = $(ui.draggable).clone();
		$controlElement.removeClass("draggableField ui-draggable ui-draggable-handle elemField select_one_click radiogroup_click selectmultiplelist_click number_click ul_click btn_click");
		$controlElement.addClass("droppedElem");

		if (globalFormObject.is_retrieving) {

			if($controlElement.children().hasClass("group1")) {

				$controlElement[0].id = "CTRL-DIV-"+(_ctrl_index);
				// $controlElement.find("select.group1").attr("name", "submitted_name" + name_count++).attr("id", count++);
				console.log(globalFormObject.sect_index);
				$controlElement.find('.optional_label').html(globalFormObject.obj.categories[_cat_index - 1002].sections[globalFormObject.sect_index - 1].controls[globalFormObject.control_index].label);
				var generated_name = globalFormObject.obj.categories[_cat_index - 1002].sections[globalFormObject.sect_index - 1].controls[globalFormObject.control_index].name;
				
				model[$controlElement[0].id] = {
										name: globalFormObject.obj.categories[_cat_index - 1002].sections[globalFormObject.sect_index - 1].controls[globalFormObject.control_index].name,
										label: globalFormObject.obj.categories[_cat_index - 1002].sections[globalFormObject.sect_index - 1].controls[globalFormObject.control_index].label,
										id: "CTRL-DIV-"+(_ctrl_index),
										required_field: globalFormObject.obj.categories[_cat_index - 1002].sections[globalFormObject.sect_index - 1].controls[globalFormObject.control_index].required_field,
										pairs: []		
								};
				
				var options = '';
				var parts = '';

				var div_ctrl = $controlElement;
				var ctrl = div_ctrl.find('select')[0];

				$.each(globalFormObject.obj.categories[_cat_index - 1002].sections[globalFormObject.sect_index - 1].controls[globalFormObject.control_index].pairs, function(index, value) {
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

				$controlElement.find("select.group1").attr("id", count++);
				$controlElement.find('select.group1').attr('name', generated_name);

				var $individualOption = div_ctrl.find("option");        
				var optionCount = 1;

			    $individualOption.each(function() {    
			      var $something = $(this);
			      if ($something.parent().is("select#1")) {	      
				      $something.attr('name', 'option' + optionCount++); 
				      // console.log($(ctrl).find('option[name="option1"]'));
				      $something.attr('class', 'generatedOptions');

				      $(ctrl).find('option[name="option1"]').attr('value', partsArray[0]);
				      $(ctrl).find('option[name="option2"]').attr('value', partsArray[1]);
				      $(ctrl).find('option[name="option3"]').attr('value', partsArray[2]);
				      $(ctrl).find('option[name="option4"]').attr('value', partsArray[3]);
				      $(ctrl).find('option[name="option5"]').attr('value', partsArray[4]);
				      $(ctrl).find('option[name="option6"]').attr('value', partsArray[5]);
				      $(ctrl).find('option[name="option7"]').attr('value', partsArray[6]);
				      $(ctrl).find('option[name="option8"]').attr('value', partsArray[7]);
				      $(ctrl).find('option[name="option9"]').attr('value', partsArray[8]);
				      $(ctrl).find('option[name="option10"]').attr('value', partsArray[9]);
				      $(ctrl).find('option[name="option11"]').attr('value', partsArray[10]);
				      $(ctrl).find('option[name="option12"]').attr('value', partsArray[11]);
				      $(ctrl).find('option[name="option13"]').attr('value', partsArray[12]);
				      $(ctrl).find('option[name="option14"]').attr('value', partsArray[13]);
				      $(ctrl).find('option[name="option15"]').attr('value', partsArray[14]);
			      } else if ($something.parent().is("select#2")) {
				      $something.attr('name', 'option' + '-' + optionCount++);
				      $something.attr('class', 'generatedOptions');
				      $(ctrl).find('option[name="option-1"]').attr('value', '(' + partsArray[0] + ')');
				      $(ctrl).find('option[name="option-2"]').attr('value', '(' + partsArray[1] + ')');
				      $(ctrl).find('option[name="option-3"]').attr('value', '(' + partsArray[2] + ')');
				      $(ctrl).find('option[name="option-4"]').attr('value', '(' + partsArray[3] + ')');
				      $(ctrl).find('option[name="option-5"]').attr('value', '(' + partsArray[4] + ')');
				      $(ctrl).find('option[name="option-6"]').attr('value', '(' + partsArray[5] + ')');
				      $(ctrl).find('option[name="option-7"]').attr('value', '(' + partsArray[6] + ')');
				      $(ctrl).find('option[name="option-8"]').attr('value', '(' + partsArray[7] + ')');
				      $(ctrl).find('option[name="option-9"]').attr('value', '(' + partsArray[8] + ')');
				      $(ctrl).find('option[name="option-10"]').attr('value', '(' + partsArray[9] + ')');
				      $(ctrl).find('option[name="option-11"]').attr('value', '(' + partsArray[10] + ')');
				      $(ctrl).find('option[name="option-12"]').attr('value', '(' + partsArray[11] + ')');
				      $(ctrl).find('option[name="option-13"]').attr('value', '(' + partsArray[12] + ')');
				      $(ctrl).find('option[name="option-14"]').attr('value', '(' + partsArray[13] + ')');
				      $(ctrl).find('option[name="option-15"]').attr('value', '(' + partsArray[14] + ')');		      
			      } else if ($something.parent().is("select#3")) {
				      $something.attr('name', 'option' + '*' + optionCount++);
				      $something.attr('class', 'generatedOptions');
				      $(ctrl).find('option[name="option*1"]').attr('value', '(' + partsArray[0] + ')');
				      $(ctrl).find('option[name="option*2"]').attr('value', '(' + partsArray[1] + ')');
				      $(ctrl).find('option[name="option*3"]').attr('value', '(' + partsArray[2] + ')');
				      $(ctrl).find('option[name="option*4"]').attr('value', '(' + partsArray[3] + ')');
				      $(ctrl).find('option[name="option*5"]').attr('value', '(' + partsArray[4] + ')');
				      $(ctrl).find('option[name="option*6"]').attr('value', '(' + partsArray[5] + ')');
				      $(ctrl).find('option[name="option*7"]').attr('value', '(' + partsArray[6] + ')');
				      $(ctrl).find('option[name="option*8"]').attr('value', '(' + partsArray[7] + ')');
				      $(ctrl).find('option[name="option*9"]').attr('value', '(' + partsArray[8] + ')');
				      $(ctrl).find('option[name="option*10"]').attr('value', '(' + partsArray[9] + ')');
				      $(ctrl).find('option[name="option*11"]').attr('value', '(' + partsArray[10] + ')');
				      $(ctrl).find('option[name="option*12"]').attr('value', '(' + partsArray[11] + ')');
				      $(ctrl).find('option[name="option*13"]').attr('value', '(' + partsArray[12] + ')');
				      $(ctrl).find('option[name="option*14"]').attr('value', '(' + partsArray[13] + ')');
				      $(ctrl).find('option[name="option*15"]').attr('value', '(' + partsArray[14] + ')');		      
			      } else if ($something.parent().is("select#4")) {
				      $something.attr('name', 'opt' + optionCount++);
				      $something.attr('class', 'generatedOptions');
				      $(ctrl).find('option[name="opt1"]').attr('value', '(' + partsArray[0] + ')');
				      $(ctrl).find('option[name="opt2"]').attr('value', '(' + partsArray[1] + ')');
				      $(ctrl).find('option[name="opt3"]').attr('value', '(' + partsArray[2] + ')');
				      $(ctrl).find('option[name="opt4"]').attr('value', '(' + partsArray[3] + ')');
				      $(ctrl).find('option[name="opt5"]').attr('value', '(' + partsArray[4] + ')');
				      $(ctrl).find('option[name="opt6"]').attr('value', '(' + partsArray[5] + ')');
				      $(ctrl).find('option[name="opt7"]').attr('value', '(' + partsArray[6] + ')');
				      $(ctrl).find('option[name="opt8"]').attr('value', '(' + partsArray[7] + ')');
				      $(ctrl).find('option[name="opt9"]').attr('value', '(' + partsArray[8] + ')');
				      $(ctrl).find('option[name="opt10"]').attr('value', '(' + partsArray[9] + ')');
				      $(ctrl).find('option[name="opt11"]').attr('value', '(' + partsArray[10] + ')');
				      $(ctrl).find('option[name="opt12"]').attr('value', '(' + partsArray[11] + ')');
				      $(ctrl).find('option[name="opt13"]').attr('value', '(' + partsArray[12] + ')');
				      $(ctrl).find('option[name="opt14"]').attr('value', '(' + partsArray[13] + ')');
				      $(ctrl).find('option[name="opt15"]').attr('value', '(' + partsArray[14] + ')');		      
				  } else if ($something.parent().is("select#5")) {
				      $something.attr('name', 'choice' + optionCount++);
				      $something.attr('class', 'generatedOptions');
				      $(ctrl).find('option[name="choice1"]').attr('value', '(' + partsArray[0] + ')');
				      $(ctrl).find('option[name="choice2"]').attr('value', '(' + partsArray[1] + ')');
				      $(ctrl).find('option[name="choice3"]').attr('value', '(' + partsArray[2] + ')');
				      $(ctrl).find('option[name="choice4"]').attr('value', '(' + partsArray[3] + ')');
				      $(ctrl).find('option[name="choice5"]').attr('value', '(' + partsArray[4] + ')');
				      $(ctrl).find('option[name="choice6"]').attr('value', '(' + partsArray[5] + ')');
				      $(ctrl).find('option[name="choice7"]').attr('value', '(' + partsArray[6] + ')');
				      $(ctrl).find('option[name="choice8"]').attr('value', '(' + partsArray[7] + ')');
				      $(ctrl).find('option[name="choice9"]').attr('value', '(' + partsArray[8] + ')');
				      $(ctrl).find('option[name="choice10"]').attr('value', '(' + partsArray[9] + ')');
				      $(ctrl).find('option[name="choice11"]').attr('value', '(' + partsArray[10] + ')');
				      $(ctrl).find('option[name="choice12"]').attr('value', '(' + partsArray[11] + ')');
				      $(ctrl).find('option[name="choice13"]').attr('value', '(' + partsArray[12] + ')');
				      $(ctrl).find('option[name="choice14"]').attr('value', '(' + partsArray[13] + ')');
				      $(ctrl).find('option[name="choice15"]').attr('value', '(' + partsArray[14] + ')');
				  } else if ($something.parent().is("select#6")) {
				      $something.attr('name', 'choice' + '_' + optionCount++);
				      $something.attr('class', 'generatedOptions');
				      $(ctrl).find('option[name="choice_1"]').attr('value', '(' + partsArray[0] + ')');
				      $(ctrl).find('option[name="choice_2"]').attr('value', '(' + partsArray[1] + ')');
				      $(ctrl).find('option[name="choice_3"]').attr('value', '(' + partsArray[2] + ')');
				      $(ctrl).find('option[name="choice_4"]').attr('value', '(' + partsArray[3] + ')');
				      $(ctrl).find('option[name="choice_5"]').attr('value', '(' + partsArray[4] + ')');
				      $(ctrl).find('option[name="choice_6"]').attr('value', '(' + partsArray[5] + ')');
				      $(ctrl).find('option[name="choice_7"]').attr('value', '(' + partsArray[6] + ')');
				      $(ctrl).find('option[name="choice_8"]').attr('value', '(' + partsArray[7] + ')');
				      $(ctrl).find('option[name="choice_9"]').attr('value', '(' + partsArray[8] + ')');
				      $(ctrl).find('option[name="choice_10"]').attr('value', '(' + partsArray[9] + ')');
				      $(ctrl).find('option[name="choice_11"]').attr('value', '(' + partsArray[10] + ')');
				      $(ctrl).find('option[name="choice_12"]').attr('value', '(' + partsArray[11] + ')');
				      $(ctrl).find('option[name="choice_13"]').attr('value', '(' + partsArray[12] + ')');
				      $(ctrl).find('option[name="choice_14"]').attr('value', '(' + partsArray[13] + ')');
				      $(ctrl).find('option[name="choice_15"]').attr('value', '(' + partsArray[14] + ')');
				  }  else if ($something.parent().is("select#7")) {
				      $something.attr('name', 'choice' + "-" + optionCount++);
				      $something.attr('class', 'generatedOptions');
				      $(ctrl).find('option[name="choice-1"]').attr('value', '(' + partsArray[0] + ')');
				      $(ctrl).find('option[name="choice-2"]').attr('value', '(' + partsArray[1] + ')');
				      $(ctrl).find('option[name="choice-3"]').attr('value', '(' + partsArray[2] + ')');
				      $(ctrl).find('option[name="choice-4"]').attr('value', '(' + partsArray[3] + ')');
				      $(ctrl).find('option[name="choice-5"]').attr('value', '(' + partsArray[4] + ')');
				      $(ctrl).find('option[name="choice-6"]').attr('value', '(' + partsArray[5] + ')');
				      $(ctrl).find('option[name="choice-7"]').attr('value', '(' + partsArray[6] + ')');
				      $(ctrl).find('option[name="choice-8"]').attr('value', '(' + partsArray[7] + ')');
				      $(ctrl).find('option[name="choice-9"]').attr('value', '(' + partsArray[8] + ')');
				      $(ctrl).find('option[name="choice-10"]').attr('value', '(' + partsArray[9] + ')');
				      $(ctrl).find('option[name="choice-11"]').attr('value', '(' + partsArray[10] + ')');
				      $(ctrl).find('option[name="choice-12"]').attr('value', '(' + partsArray[11] + ')');
				      $(ctrl).find('option[name="choice-13"]').attr('value', '(' + partsArray[12] + ')');
				      $(ctrl).find('option[name="choice-14"]').attr('value', '(' + partsArray[13] + ')');
				      $(ctrl).find('option[name="choice-15"]').attr('value', '(' + partsArray[14] + ')');
				  }  else if ($something.parent().is("select#8")) {
				      $something.attr('name', 'ch' + optionCount++);
				      $something.attr('class', 'generatedOptions');
				      $(ctrl).find('option[name="ch1"]').attr('value', '(' + partsArray[0] + ')');
				      $(ctrl).find('option[name="ch2"]').attr('value', '(' + partsArray[1] + ')');
				      $(ctrl).find('option[name="ch3"]').attr('value', '(' + partsArray[2] + ')');
				      $(ctrl).find('option[name="ch4"]').attr('value', '(' + partsArray[3] + ')');
				      $(ctrl).find('option[name="ch5"]').attr('value', '(' + partsArray[4] + ')');
				      $(ctrl).find('option[name="ch6"]').attr('value', '(' + partsArray[5] + ')');
				      $(ctrl).find('option[name="ch7"]').attr('value', '(' + partsArray[6] + ')');
				      $(ctrl).find('option[name="ch8"]').attr('value', '(' + partsArray[7] + ')');
				      $(ctrl).find('option[name="ch9"]').attr('value', '(' + partsArray[8] + ')');
				      $(ctrl).find('option[name="ch10"]').attr('value', '(' + partsArray[9] + ')');
				      $(ctrl).find('option[name="ch11"]').attr('value', '(' + partsArray[10] + ')');
				      $(ctrl).find('option[name="ch12"]').attr('value', '(' + partsArray[11] + ')');
				      $(ctrl).find('option[name="ch13"]').attr('value', '(' + partsArray[12] + ')');
				      $(ctrl).find('option[name="ch14"]').attr('value', '(' + partsArray[13] + ')');
				      $(ctrl).find('option[name="ch15"]').attr('value', '(' + partsArray[14] + ')');
				  }  else if ($something.parent().is("select#9")) {
				      $something.attr('name', 'choices' + optionCount++);
				      $something.attr('class', 'generatedOptions');
				      $(ctrl).find('option[name="choices1"]').attr('value', '(' + partsArray[0] + ')');
				      $(ctrl).find('option[name="choices2"]').attr('value', '(' + partsArray[1] + ')');
				      $(ctrl).find('option[name="choices3"]').attr('value', '(' + partsArray[2] + ')');
				      $(ctrl).find('option[name="choices4"]').attr('value', '(' + partsArray[3] + ')');
				      $(ctrl).find('option[name="choices5"]').attr('value', '(' + partsArray[4] + ')');
				      $(ctrl).find('option[name="choices6"]').attr('value', '(' + partsArray[5] + ')');
				      $(ctrl).find('option[name="choices7"]').attr('value', '(' + partsArray[6] + ')');
				      $(ctrl).find('option[name="choices8"]').attr('value', '(' + partsArray[7] + ')');
				      $(ctrl).find('option[name="choices9"]').attr('value', '(' + partsArray[8] + ')');
				      $(ctrl).find('option[name="choices10"]').attr('value', '(' + partsArray[9] + ')');
				      $(ctrl).find('option[name="choices11"]').attr('value', '(' + partsArray[10] + ')');
				      $(ctrl).find('option[name="choices12"]').attr('value', '(' + partsArray[11] + ')');
				      $(ctrl).find('option[name="choices13"]').attr('value', '(' + partsArray[12] + ')');
				      $(ctrl).find('option[name="choices14"]').attr('value', '(' + partsArray[13] + ')');
				      $(ctrl).find('option[name="choices15"]').attr('value', '(' + partsArray[14] + ')');
				  }  else if ($something.parent().is("select#10")) {
				      $something.attr('name', 'sel' + optionCount++);
				      $something.attr('class', 'generatedOptions');
				      $(ctrl).find('option[name="sel1"]').attr('value', '(' + partsArray[0] + ')');
				      $(ctrl).find('option[name="sel2"]').attr('value', '(' + partsArray[1] + ')');
				      $(ctrl).find('option[name="sel3"]').attr('value', '(' + partsArray[2] + ')');
				      $(ctrl).find('option[name="sel4"]').attr('value', '(' + partsArray[3] + ')');
				      $(ctrl).find('option[name="sel5"]').attr('value', '(' + partsArray[4] + ')');
				      $(ctrl).find('option[name="sel6"]').attr('value', '(' + partsArray[5] + ')');
				      $(ctrl).find('option[name="sel7"]').attr('value', '(' + partsArray[6] + ')');
				      $(ctrl).find('option[name="sel8"]').attr('value', '(' + partsArray[7] + ')');
				      $(ctrl).find('option[name="sel9"]').attr('value', '(' + partsArray[8] + ')');
				      $(ctrl).find('option[name="sel10"]').attr('value', '(' + partsArray[9] + ')');
				      $(ctrl).find('option[name="sel11"]').attr('value', '(' + partsArray[10] + ')');
				      $(ctrl).find('option[name="sel12"]').attr('value', '(' + partsArray[11] + ')');
				      $(ctrl).find('option[name="sel13"]').attr('value', '(' + partsArray[12] + ')');
				      $(ctrl).find('option[name="sel14"]').attr('value', '(' + partsArray[13] + ')');
				      $(ctrl).find('option[name="sel15"]').attr('value', '(' + partsArray[14] + ')');
				  }  else if ($something.parent().is("select#11")) {
				      $something.attr('name', 'sel-' + optionCount++);
				      $something.attr('class', 'generatedOptions');
				      $(ctrl).find('option[name="sel-1"]').attr('value', '(' + partsArray[0] + ')');
				      $(ctrl).find('option[name="sel-2"]').attr('value', '(' + partsArray[1] + ')');
				      $(ctrl).find('option[name="sel-3"]').attr('value', '(' + partsArray[2] + ')');
				      $(ctrl).find('option[name="sel-4"]').attr('value', '(' + partsArray[3] + ')');
				      $(ctrl).find('option[name="sel-5"]').attr('value', '(' + partsArray[4] + ')');
				      $(ctrl).find('option[name="sel-6"]').attr('value', '(' + partsArray[5] + ')');
				      $(ctrl).find('option[name="sel-7"]').attr('value', '(' + partsArray[6] + ')');
				      $(ctrl).find('option[name="sel-8"]').attr('value', '(' + partsArray[7] + ')');
				      $(ctrl).find('option[name="sel-9"]').attr('value', '(' + partsArray[8] + ')');
				      $(ctrl).find('option[name="sel-10"]').attr('value', '(' + partsArray[9] + ')');
				      $(ctrl).find('option[name="sel-11"]').attr('value', '(' + partsArray[10] + ')');
				      $(ctrl).find('option[name="sel-12"]').attr('value', '(' + partsArray[11] + ')');
				      $(ctrl).find('option[name="sel-13"]').attr('value', '(' + partsArray[12] + ')');
				      $(ctrl).find('option[name="sel-14"]').attr('value', '(' + partsArray[13] + ')');
				      $(ctrl).find('option[name="sel-15"]').attr('value', '(' + partsArray[14] + ')');
				  }  else if ($something.parent().is("select#12")) {
				      $something.attr('name', 'select' + optionCount++);
				      $something.attr('class', 'generatedOptions');
				      $(ctrl).find('option[name="select1"]').attr('value', '(' + partsArray[0] + ')');
				      $(ctrl).find('option[name="select2"]').attr('value', '(' + partsArray[1] + ')');
				      $(ctrl).find('option[name="select3"]').attr('value', '(' + partsArray[2] + ')');
				      $(ctrl).find('option[name="select4"]').attr('value', '(' + partsArray[3] + ')');
				      $(ctrl).find('option[name="select5"]').attr('value', '(' + partsArray[4] + ')');
				      $(ctrl).find('option[name="select6"]').attr('value', '(' + partsArray[5] + ')');
				      $(ctrl).find('option[name="select7"]').attr('value', '(' + partsArray[6] + ')');
				      $(ctrl).find('option[name="select8"]').attr('value', '(' + partsArray[7] + ')');
				      $(ctrl).find('option[name="select9"]').attr('value', '(' + partsArray[8] + ')');
				      $(ctrl).find('option[name="select10"]').attr('value', '(' + partsArray[9] + ')');
				      $(ctrl).find('option[name="select11"]').attr('value', '(' + partsArray[10] + ')');
				      $(ctrl).find('option[name="select12"]').attr('value', '(' + partsArray[11] + ')');
				      $(ctrl).find('option[name="select13"]').attr('value', '(' + partsArray[12] + ')');
				      $(ctrl).find('option[name="select14"]').attr('value', '(' + partsArray[13] + ')');
				      $(ctrl).find('option[name="select15"]').attr('value', '(' + partsArray[14] + ')');
				  }  else if ($something.parent().is("select#13")) {
				      $something.attr('name', 'select_' + optionCount++);
				      $something.attr('class', 'generatedOptions');
				      $(ctrl).find('option[name="select_1"]').attr('value', '(' + partsArray[0] + ')');
				      $(ctrl).find('option[name="select_2"]').attr('value', '(' + partsArray[1] + ')');
				      $(ctrl).find('option[name="select_3"]').attr('value', '(' + partsArray[2] + ')');
				      $(ctrl).find('option[name="select_4"]').attr('value', '(' + partsArray[3] + ')');
				      $(ctrl).find('option[name="select_5"]').attr('value', '(' + partsArray[4] + ')');
				      $(ctrl).find('option[name="select_6"]').attr('value', '(' + partsArray[5] + ')');
				      $(ctrl).find('option[name="select_7"]').attr('value', '(' + partsArray[6] + ')');
				      $(ctrl).find('option[name="select_8"]').attr('value', '(' + partsArray[7] + ')');
				      $(ctrl).find('option[name="select_9"]').attr('value', '(' + partsArray[8] + ')');
				      $(ctrl).find('option[name="select_10"]').attr('value', '(' + partsArray[9] + ')');
				      $(ctrl).find('option[name="select_11"]').attr('value', '(' + partsArray[10] + ')');
				      $(ctrl).find('option[name="select_12"]').attr('value', '(' + partsArray[11] + ')');
				      $(ctrl).find('option[name="select_13"]').attr('value', '(' + partsArray[12] + ')');
				      $(ctrl).find('option[name="select_14"]').attr('value', '(' + partsArray[13] + ')');
				      $(ctrl).find('option[name="select_15"]').attr('value', '(' + partsArray[14] + ')');
				  }  else if ($something.parent().is("select#14")) {
				      $something.attr('name', 'select-' + optionCount++);
				      $something.attr('class', 'generatedOptions');
				      $(ctrl).find('option[name="select-1"]').attr('value', '(' + partsArray[0] + ')');
				      $(ctrl).find('option[name="select-2"]').attr('value', '(' + partsArray[1] + ')');
				      $(ctrl).find('option[name="select-3"]').attr('value', '(' + partsArray[2] + ')');
				      $(ctrl).find('option[name="select-4"]').attr('value', '(' + partsArray[3] + ')');
				      $(ctrl).find('option[name="select-5"]').attr('value', '(' + partsArray[4] + ')');
				      $(ctrl).find('option[name="select-6"]').attr('value', '(' + partsArray[5] + ')');
				      $(ctrl).find('option[name="select-7"]').attr('value', '(' + partsArray[6] + ')');
				      $(ctrl).find('option[name="select-8"]').attr('value', '(' + partsArray[7] + ')');
				      $(ctrl).find('option[name="select-9"]').attr('value', '(' + partsArray[8] + ')');
				      $(ctrl).find('option[name="select-10"]').attr('value', '(' + partsArray[9] + ')');
				      $(ctrl).find('option[name="select-11"]').attr('value', '(' + partsArray[10] + ')');
				      $(ctrl).find('option[name="select-12"]').attr('value', '(' + partsArray[11] + ')');
				      $(ctrl).find('option[name="select-13"]').attr('value', '(' + partsArray[12] + ')');
				      $(ctrl).find('option[name="select-14"]').attr('value', '(' + partsArray[13] + ')');
				      $(ctrl).find('option[name="select-15"]').attr('value', '(' + partsArray[14] + ')');
				  }  else if ($something.parent().is("select#15")) {
				      $something.attr('name', 's' + optionCount++);
				      $something.attr('class', 'generatedOptions');
				      $(ctrl).find('option[name="s1"]').attr('value', '(' + partsArray[0] + ')');
				      $(ctrl).find('option[name="s2"]').attr('value', '(' + partsArray[1] + ')');
				      $(ctrl).find('option[name="s3"]').attr('value', '(' + partsArray[2] + ')');
				      $(ctrl).find('option[name="s4"]').attr('value', '(' + partsArray[3] + ')');
				      $(ctrl).find('option[name="s5"]').attr('value', '(' + partsArray[4] + ')');
				      $(ctrl).find('option[name="s6"]').attr('value', '(' + partsArray[5] + ')');
				      $(ctrl).find('option[name="s7"]').attr('value', '(' + partsArray[6] + ')');
				      $(ctrl).find('option[name="s8"]').attr('value', '(' + partsArray[7] + ')');
				      $(ctrl).find('option[name="s9"]').attr('value', '(' + partsArray[8] + ')');
				      $(ctrl).find('option[name="s10"]').attr('value', '(' + partsArray[9] + ')');
				      $(ctrl).find('option[name="s11"]').attr('value', '(' + partsArray[10] + ')');
				      $(ctrl).find('option[name="s12"]').attr('value', '(' + partsArray[11] + ')');
				      $(ctrl).find('option[name="s13"]').attr('value', '(' + partsArray[12] + ')');
				      $(ctrl).find('option[name="s14"]').attr('value', '(' + partsArray[13] + ')');
				      $(ctrl).find('option[name="s15"]').attr('value', '(' + partsArray[14] + ')');
				  } 

						$(ctrl).parent().find('.group1 option').each(function() {
									if ($(this).text() == "") {
										$(this).remove();
									}
						});

				});
			
				_ctrl_index++;
				globalFormObject.control_index++;

			} else if ($controlElement.children().hasClass('ctrl-radiogroup')) {
				$controlElement[0].id = "CTRL-DIV-"+(_ctrl_index);
				$controlElement.find('.makeBold').html(globalFormObject.obj.categories[_cat_index - 1002].sections[globalFormObject.sect_index - 1].controls[globalFormObject.control_index].label);


				$controlElement.find('.required_radio').attr('name', globalFormObject.obj.categories[_cat_index - 1002].sections[globalFormObject.sect_index - 1].controls[globalFormObject.control_index].pairs[0].n);
				$controlElement.find('.required_radio').attr('value', "r(" + globalFormObject.obj.categories[_cat_index - 1002].sections[globalFormObject.sect_index - 1].controls[globalFormObject.control_index].pairs[0].v + ")");

				$controlElement.find('.optional_radio').attr('name', globalFormObject.obj.categories[_cat_index - 1002].sections[globalFormObject.sect_index - 1].controls[globalFormObject.control_index].pairs[0].n);
				$controlElement.find('.optional_radio').attr('value', "o(" + globalFormObject.obj.categories[_cat_index - 1002].sections[globalFormObject.sect_index - 1].controls[globalFormObject.control_index].pairs[0].v + ")");

				$controlElement.find('.na_radio').attr('name', globalFormObject.obj.categories[_cat_index - 1002].sections[globalFormObject.sect_index - 1].controls[globalFormObject.control_index].pairs[0].n);
				$controlElement.find('.na_radio').attr('value', "n(" + globalFormObject.obj.categories[_cat_index - 1002].sections[globalFormObject.sect_index - 1].controls[globalFormObject.control_index].pairs[0].v + ")");

				$controlElement.find('.placeHolderClass').attr('name', globalFormObject.obj.categories[_cat_index - 1002].sections[globalFormObject.sect_index - 1].controls[globalFormObject.control_index].pairs[0].n);
				$controlElement.find('.placeHolderClass').attr('value', globalFormObject.obj.categories[_cat_index - 1002].sections[globalFormObject.sect_index - 1].controls[globalFormObject.control_index].pairs[0].v);

				 model[$controlElement[0].id] = {
				// 						name: globalFormObject.obj.categories[_cat_index - 1002].sections[globalFormObject.sect_index - 1].controls[globalFormObject.control_index].name,
				// 						label: globalFormObject.obj.categories[_cat_index - 1002].sections[globalFormObject.sect_index - 1].controls[globalFormObject.control_index].label,
				// 						id: "CTRL-DIV-"+(_ctrl_index),
				 						required_field: globalFormObject.obj.categories[_cat_index - 1002].sections[globalFormObject.sect_index - 1].controls[globalFormObject.control_index].required_field
				// 						pairs: []		
				 				};

				_ctrl_index++;
				globalFormObject.control_index++;

			}else if($controlElement.children().children().hasClass('group3')) {
				$controlElement[0].id = "CTRL-DIV-"+(_ctrl_index);
				$controlElement.find("select.group3").attr("name", "submitted_multiple" + name_count_mult).attr("id", "select" + count2);
				$controlElement.find('.optional_label_mult').html(globalFormObject.obj.categories[_cat_index - 1002].sections[globalFormObject.sect_index - 1].controls[globalFormObject.control_index].label);
				var generated_name = globalFormObject.obj.categories[_cat_index - 1002].sections[globalFormObject.sect_index - 1].controls[globalFormObject.control_index].name;
				
				model[$controlElement[0].id] = {
										name: globalFormObject.obj.categories[_cat_index - 1002].sections[globalFormObject.sect_index - 1].controls[globalFormObject.control_index].name,
										label: globalFormObject.obj.categories[_cat_index - 1002].sections[globalFormObject.sect_index - 1].controls[globalFormObject.control_index].label,
										id: "CTRL-DIV-"+(_ctrl_index),
										required_field: globalFormObject.obj.categories[_cat_index - 1002].sections[globalFormObject.sect_index - 1].controls[globalFormObject.control_index].required_field,
										pairs: []		
								};

				var options = '';
				var parts = '';

				var div_ctrl = $controlElement;
				var ctrl = div_ctrl.find('select')[0];

				$.each(globalFormObject.obj.categories[_cat_index - 1002].sections[globalFormObject.sect_index - 1].controls[globalFormObject.control_index].pairs, function(index, value) {
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
				$controlElement.find('select.group3').attr('name', generated_name);

			    	var $individualOption = div_ctrl.find("option");        
					var optionCount = 1;

				    $individualOption.each(function() {    
				      var $something = $(this);
				      if ($something.parent().is("select#select1")) {
				         $something.attr('name', 'selectmult' + optionCount++);
				         $something.attr('class', 'multiGroup');
				         $(ctrl).find('option[name="selectmult1"]').attr('value', '(' + partsArray[0] + ')');
				         $(ctrl).find('option[name="selectmult2"]').attr('value', '(' + partsArray[1] + ')');
				         $(ctrl).find('option[name="selectmult3"]').attr('value', '(' + partsArray[2] + ')');
				         $(ctrl).find('option[name="selectmult4"]').attr('value', '(' + partsArray[3] + ')');
				         $(ctrl).find('option[name="selectmult5"]').attr('value', '(' + partsArray[4] + ')');
				         $(ctrl).find('option[name="selectmult6"]').attr('value', '(' + partsArray[5] + ')');
				         $(ctrl).find('option[name="selectmult7"]').attr('value', '(' + partsArray[6] + ')');
				         $(ctrl).find('option[name="selectmult8"]').attr('value', '(' + partsArray[7] + ')');
				         $(ctrl).find('option[name="selectmult9"]').attr('value', '(' + partsArray[8] + ')');
				         $(ctrl).find('option[name="selectmult10"]').attr('value', '(' + partsArray[9] + ')');
				         $(ctrl).find('option[name="selectmult11"]').attr('value', '(' + partsArray[10] + ')');
				         $(ctrl).find('option[name="selectmult12"]').attr('value', '(' + partsArray[11] + ')');
				         $(ctrl).find('option[name="selectmult13"]').attr('value', '(' + partsArray[12] + ')');
				         $(ctrl).find('option[name="selectmult14"]').attr('value', '(' + partsArray[13] + ')');
				         $(ctrl).find('option[name="selectmult15"]').attr('value', '(' + partsArray[14] + ')');
				      } else if ($something.parent().is("select#select2")) {
				      	 $something.attr('name', 'selectmult' + '_' + optionCount++);
				         $something.attr('class', 'multiGroup');
				         $(ctrl).find('option[name="selectmult_1"]').attr('value', '(' + partsArray[0] + ')');
				         $(ctrl).find('option[name="selectmult_2"]').attr('value', '(' + partsArray[1] + ')');
				         $(ctrl).find('option[name="selectmult_3"]').attr('value', '(' + partsArray[2] + ')');
				         $(ctrl).find('option[name="selectmult_4"]').attr('value', '(' + partsArray[3] + ')');
				         $(ctrl).find('option[name="selectmult_5"]').attr('value', '(' + partsArray[4] + ')');
				         $(ctrl).find('option[name="selectmult_6"]').attr('value', '(' + partsArray[5] + ')');
				         $(ctrl).find('option[name="selectmult_7"]').attr('value', '(' + partsArray[6] + ')');
				         $(ctrl).find('option[name="selectmult_8"]').attr('value', '(' + partsArray[7] + ')');
				         $(ctrl).find('option[name="selectmult_9"]').attr('value', '(' + partsArray[8] + ')');
				         $(ctrl).find('option[name="selectmult_10"]').attr('value', '(' + partsArray[9] + ')');
				         $(ctrl).find('option[name="selectmult_11"]').attr('value', '(' + partsArray[10] + ')');
				         $(ctrl).find('option[name="selectmult_12"]').attr('value', '(' + partsArray[11] + ')');
				         $(ctrl).find('option[name="selectmult_13"]').attr('value', '(' + partsArray[12] + ')');
				         $(ctrl).find('option[name="selectmult_14"]').attr('value', '(' + partsArray[13] + ')');
				         $(ctrl).find('option[name="selectmult_15"]').attr('value', '(' + partsArray[14] + ')');
				      } else if ($something.parent().is("select#select3")) {
				      	 $something.attr('name', 'selectmult' + '-' + optionCount++);
				         $something.attr('class', 'multiGroup');
				         $(ctrl).find('option[name="selectmult-1"]').attr('value', '(' + partsArray[0] + ')');
				         $(ctrl).find('option[name="selectmult-2"]').attr('value', '(' + partsArray[1] + ')');
				         $(ctrl).find('option[name="selectmult-3"]').attr('value', '(' + partsArray[2] + ')');
				         $(ctrl).find('option[name="selectmult-4"]').attr('value', '(' + partsArray[3] + ')');
				         $(ctrl).find('option[name="selectmult-5"]').attr('value', '(' + partsArray[4] + ')');
				         $(ctrl).find('option[name="selectmult-6"]').attr('value', '(' + partsArray[5] + ')');
				         $(ctrl).find('option[name="selectmult-7"]').attr('value', '(' + partsArray[6] + ')');
				         $(ctrl).find('option[name="selectmult-8"]').attr('value', '(' + partsArray[7] + ')');
				         $(ctrl).find('option[name="selectmult-9"]').attr('value', '(' + partsArray[8] + ')');
				         $(ctrl).find('option[name="selectmult-10"]').attr('value', '(' + partsArray[9] + ')');
				         $(ctrl).find('option[name="selectmult-11"]').attr('value', '(' + partsArray[10] + ')');
				         $(ctrl).find('option[name="selectmult-12"]').attr('value', '(' + partsArray[11] + ')');
				         $(ctrl).find('option[name="selectmult-13"]').attr('value', '(' + partsArray[12] + ')');
				         $(ctrl).find('option[name="selectmult-14"]').attr('value', '(' + partsArray[13] + ')');
				         $(ctrl).find('option[name="selectmult-15"]').attr('value', '(' + partsArray[14] + ')');
				      } else if ($something.parent().is("select#select4")) {
				      	 $something.attr('name', 'selectchoice' + '-' + optionCount++);
				         $something.attr('class', 'multiGroup');
				         $(ctrl).find('option[name="selectchoice-1"]').attr('value', '(' + partsArray[0] + ')');
				         $(ctrl).find('option[name="selectchoice-2"]').attr('value', '(' + partsArray[1] + ')');
				         $(ctrl).find('option[name="selectchoice-3"]').attr('value', '(' + partsArray[2] + ')');
				         $(ctrl).find('option[name="selectchoice-4"]').attr('value', '(' + partsArray[3] + ')');
				         $(ctrl).find('option[name="selectchoice-5"]').attr('value', '(' + partsArray[4] + ')');
				         $(ctrl).find('option[name="selectchoice-6"]').attr('value', '(' + partsArray[5] + ')');
				         $(ctrl).find('option[name="selectchoice-7"]').attr('value', '(' + partsArray[6] + ')');
				         $(ctrl).find('option[name="selectchoice-8"]').attr('value', '(' + partsArray[7] + ')');
				         $(ctrl).find('option[name="selectchoice-9"]').attr('value', '(' + partsArray[8] + ')');
				         $(ctrl).find('option[name="selectchoice-10"]').attr('value', '(' + partsArray[9] + ')');
				         $(ctrl).find('option[name="selectchoice-11"]').attr('value', '(' + partsArray[10] + ')');
				         $(ctrl).find('option[name="selectchoice-12"]').attr('value', '(' + partsArray[11] + ')');
				         $(ctrl).find('option[name="selectchoice-13"]').attr('value', '(' + partsArray[12] + ')');
				         $(ctrl).find('option[name="selectchoice-14"]').attr('value', '(' + partsArray[13] + ')');
				         $(ctrl).find('option[name="selectchoice-15"]').attr('value', '(' + partsArray[14] + ')');
				      } else if ($something.parent().is("select#select5")) {
				      	 $something.attr('name', 'mult' + '_' + optionCount++);
				         $something.attr('class', 'multiGroup');
				         $(ctrl).find('option[name="mult_1"]').attr('value', '(' + partsArray[0] + ')');
				         $(ctrl).find('option[name="mult_2"]').attr('value', '(' + partsArray[1] + ')');
				         $(ctrl).find('option[name="mult_3"]').attr('value', '(' + partsArray[2] + ')');
				         $(ctrl).find('option[name="mult_4"]').attr('value', '(' + partsArray[3] + ')');
				         $(ctrl).find('option[name="mult_5"]').attr('value', '(' + partsArray[4] + ')');
				         $(ctrl).find('option[name="mult_6"]').attr('value', '(' + partsArray[5] + ')');
				         $(ctrl).find('option[name="mult_7"]').attr('value', '(' + partsArray[6] + ')');
				         $(ctrl).find('option[name="mult_8"]').attr('value', '(' + partsArray[7] + ')');
				         $(ctrl).find('option[name="mult_9"]').attr('value', '(' + partsArray[8] + ')');
				         $(ctrl).find('option[name="mult_10"]').attr('value', '(' + partsArray[9] + ')');
				         $(ctrl).find('option[name="mult_11"]').attr('value', '(' + partsArray[10] + ')');
				         $(ctrl).find('option[name="mult_12"]').attr('value', '(' + partsArray[11] + ')');
				         $(ctrl).find('option[name="mult_13"]').attr('value', '(' + partsArray[12] + ')');
				         $(ctrl).find('option[name="mult_14"]').attr('value', '(' + partsArray[13] + ')');
				         $(ctrl).find('option[name="mult_15"]').attr('value', '(' + partsArray[14] + ')');
				      } else if ($something.parent().is("select#select6")) {
				      	 $something.attr('name', 'mult' + '-' + optionCount++);
				         $something.attr('class', 'multiGroup');
				         $(ctrl).find('option[name="mult-1"]').attr('value', '(' + partsArray[0] + ')');
				         $(ctrl).find('option[name="mult-2"]').attr('value', '(' + partsArray[1] + ')');
				         $(ctrl).find('option[name="mult-3"]').attr('value', '(' + partsArray[2] + ')');
				         $(ctrl).find('option[name="mult-4"]').attr('value', '(' + partsArray[3] + ')');
				         $(ctrl).find('option[name="mult-5"]').attr('value', '(' + partsArray[4] + ')');
				         $(ctrl).find('option[name="mult-6"]').attr('value', '(' + partsArray[5] + ')');
				         $(ctrl).find('option[name="mult-7"]').attr('value', '(' + partsArray[6] + ')');
				         $(ctrl).find('option[name="mult-8"]').attr('value', '(' + partsArray[7] + ')');
				         $(ctrl).find('option[name="mult-9"]').attr('value', '(' + partsArray[8] + ')');
				         $(ctrl).find('option[name="mult-10"]').attr('value', '(' + partsArray[9] + ')');
				         $(ctrl).find('option[name="mult-11"]').attr('value', '(' + partsArray[10] + ')');
				         $(ctrl).find('option[name="mult-12"]').attr('value', '(' + partsArray[11] + ')');
				         $(ctrl).find('option[name="mult-13"]').attr('value', '(' + partsArray[12] + ')');
				         $(ctrl).find('option[name="mult-14"]').attr('value', '(' + partsArray[13] + ')');
				         $(ctrl).find('option[name="mult-15"]').attr('value', '(' + partsArray[14] + ')');
				      } else if ($something.parent().is("select#select7")) {
				      	 $something.attr('name', 'mult' + '' + optionCount++);
				         $something.attr('class', 'multiGroup');
				         $(ctrl).find('option[name="mult1"]').attr('value', '(' + partsArray[0] + ')');
				         $(ctrl).find('option[name="mult2"]').attr('value', '(' + partsArray[1] + ')');
				         $(ctrl).find('option[name="mult3"]').attr('value', '(' + partsArray[2] + ')');
				         $(ctrl).find('option[name="mult4"]').attr('value', '(' + partsArray[3] + ')');
				         $(ctrl).find('option[name="mult5"]').attr('value', '(' + partsArray[4] + ')');
				         $(ctrl).find('option[name="mult6"]').attr('value', '(' + partsArray[5] + ')');
				         $(ctrl).find('option[name="mult7"]').attr('value', '(' + partsArray[6] + ')');
				         $(ctrl).find('option[name="mult8"]').attr('value', '(' + partsArray[7] + ')');
				         $(ctrl).find('option[name="mult9"]').attr('value', '(' + partsArray[8] + ')');
				         $(ctrl).find('option[name="mult10"]').attr('value', '(' + partsArray[9] + ')');
				         $(ctrl).find('option[name="mult11"]').attr('value', '(' + partsArray[10] + ')');
				         $(ctrl).find('option[name="mult12"]').attr('value', '(' + partsArray[11] + ')');
				         $(ctrl).find('option[name="mult13"]').attr('value', '(' + partsArray[12] + ')');
				         $(ctrl).find('option[name="mult14"]').attr('value', '(' + partsArray[13] + ')');
				         $(ctrl).find('option[name="mult15"]').attr('value', '(' + partsArray[14] + ')');
				      } else if ($something.parent().is("select#select8")) {
				      	 $something.attr('name', 'sm' + '_' + optionCount++);
				         $something.attr('class', 'multiGroup');
				         $(ctrl).find('option[name="sm_1"]').attr('value', '(' + partsArray[0] + ')');
				         $(ctrl).find('option[name="sm_2"]').attr('value', '(' + partsArray[1] + ')');
				         $(ctrl).find('option[name="sm_3"]').attr('value', '(' + partsArray[2] + ')');
				         $(ctrl).find('option[name="sm_4"]').attr('value', '(' + partsArray[3] + ')');
				         $(ctrl).find('option[name="sm_5"]').attr('value', '(' + partsArray[4] + ')');
				         $(ctrl).find('option[name="sm_6"]').attr('value', '(' + partsArray[5] + ')');
				         $(ctrl).find('option[name="sm_7"]').attr('value', '(' + partsArray[6] + ')');
				         $(ctrl).find('option[name="sm_8"]').attr('value', '(' + partsArray[7] + ')');
				         $(ctrl).find('option[name="sm_9"]').attr('value', '(' + partsArray[8] + ')');
				         $(ctrl).find('option[name="sm_10"]').attr('value', '(' + partsArray[9] + ')');
				         $(ctrl).find('option[name="sm_11"]').attr('value', '(' + partsArray[10] + ')');
				         $(ctrl).find('option[name="sm_12"]').attr('value', '(' + partsArray[11] + ')');
				         $(ctrl).find('option[name="sm_13"]').attr('value', '(' + partsArray[12] + ')');
				         $(ctrl).find('option[name="sm_14"]').attr('value', '(' + partsArray[13] + ')');
				         $(ctrl).find('option[name="sm_15"]').attr('value', '(' + partsArray[14] + ')');
				      } else if ($something.parent().is("select#select9")) {
				      	 $something.attr('name', 'sm' + '' + optionCount++);
				         $something.attr('class', 'multiGroup');
				         $(ctrl).find('option[name="sm1"]').attr('value', '(' + partsArray[0] + ')');
				         $(ctrl).find('option[name="sm2"]').attr('value', '(' + partsArray[1] + ')');
				         $(ctrl).find('option[name="sm3"]').attr('value', '(' + partsArray[2] + ')');
				         $(ctrl).find('option[name="sm4"]').attr('value', '(' + partsArray[3] + ')');
				         $(ctrl).find('option[name="sm5"]').attr('value', '(' + partsArray[4] + ')');
				         $(ctrl).find('option[name="sm6"]').attr('value', '(' + partsArray[5] + ')');
				         $(ctrl).find('option[name="sm7"]').attr('value', '(' + partsArray[6] + ')');
				         $(ctrl).find('option[name="sm8"]').attr('value', '(' + partsArray[7] + ')');
				         $(ctrl).find('option[name="sm9"]').attr('value', '(' + partsArray[8] + ')');
				         $(ctrl).find('option[name="sm10"]').attr('value', '(' + partsArray[9] + ')');
				         $(ctrl).find('option[name="sm11"]').attr('value', '(' + partsArray[10] + ')');
				         $(ctrl).find('option[name="sm12"]').attr('value', '(' + partsArray[11] + ')');
				         $(ctrl).find('option[name="sm13"]').attr('value', '(' + partsArray[12] + ')');
				         $(ctrl).find('option[name="sm14"]').attr('value', '(' + partsArray[13] + ')');
				         $(ctrl).find('option[name="sm15"]').attr('value', '(' + partsArray[14] + ')');
				      } else if ($something.parent().is("select#select10")) {
				      	 $something.attr('name', 'sm' + '-' + optionCount++);
				         $something.attr('class', 'multiGroup');
				         $(ctrl).find('option[name="sm-1"]').attr('value', '(' + partsArray[0] + ')');
				         $(ctrl).find('option[name="sm-2"]').attr('value', '(' + partsArray[1] + ')');
				         $(ctrl).find('option[name="sm-3"]').attr('value', '(' + partsArray[2] + ')');
				         $(ctrl).find('option[name="sm-4"]').attr('value', '(' + partsArray[3] + ')');
				         $(ctrl).find('option[name="sm-5"]').attr('value', '(' + partsArray[4] + ')');
				         $(ctrl).find('option[name="sm-6"]').attr('value', '(' + partsArray[5] + ')');
				         $(ctrl).find('option[name="sm-7"]').attr('value', '(' + partsArray[6] + ')');
				         $(ctrl).find('option[name="sm-8"]').attr('value', '(' + partsArray[7] + ')');
				         $(ctrl).find('option[name="sm-9"]').attr('value', '(' + partsArray[8] + ')');
				         $(ctrl).find('option[name="sm-10"]').attr('value', '(' + partsArray[9] + ')');
				         $(ctrl).find('option[name="sm-11"]').attr('value', '(' + partsArray[10] + ')');
				         $(ctrl).find('option[name="sm-12"]').attr('value', '(' + partsArray[11] + ')');
				         $(ctrl).find('option[name="sm-13"]').attr('value', '(' + partsArray[12] + ')');
				         $(ctrl).find('option[name="sm-14"]').attr('value', '(' + partsArray[13] + ')');
				         $(ctrl).find('option[name="sm-15"]').attr('value', '(' + partsArray[14] + ')');
				      }

				      	$(ctrl).parent().find('.group3 option').each(function() {
									if ($(this).text() == "") {
										$(this).remove();
									}
						});
				    });
				
				_ctrl_index++;
				globalFormObject.control_index++;

			} else if($controlElement.children().hasClass('number_group')) {
				
				$controlElement[0].id = "CTRL-DIV-"+(_ctrl_index);
				$controlElement.find('.number_option').html(globalFormObject.obj.categories[_cat_index - 1002].sections[globalFormObject.sect_index - 1].controls[globalFormObject.control_index].label);
				$controlElement.find('.ctrl-number').attr('name', globalFormObject.obj.categories[_cat_index - 1002].sections[globalFormObject.sect_index - 1].controls[globalFormObject.control_index].name);
				$controlElement.find('.ctrl-number').attr('min', globalFormObject.obj.categories[_cat_index - 1002].sections[globalFormObject.sect_index - 1].controls[globalFormObject.control_index].min);
				$controlElement.find('.ctrl-number').attr('max', globalFormObject.obj.categories[_cat_index - 1002].sections[globalFormObject.sect_index - 1].controls[globalFormObject.control_index].max);
				$controlElement.find('.ctrl-number').attr('step', globalFormObject.obj.categories[_cat_index - 1002].sections[globalFormObject.sect_index - 1].controls[globalFormObject.control_index].step);
				_ctrl_index++;
				globalFormObject.control_index++;

			} else if($controlElement.children().hasClass('ctrl-unordered_list')) {
				$controlElement[0].id = "CTRL-DIV-"+(_ctrl_index);
				$controlElement.find('.ul_txt').html(globalFormObject.obj.categories[_cat_index - 1002].sections[globalFormObject.sect_index - 1].controls[globalFormObject.control_index].label);
				_ctrl_index++;
				globalFormObject.control_index++;	

			} else if($controlElement.children().hasClass('ctrl-button')) {
				console.log('ping');
				$controlElement[0].id = "CTRL-DIV-"+(_ctrl_index);
				$controlElement.find('a').html(globalFormObject.obj.categories[_cat_index - 1002].sections[globalFormObject.sect_index - 1].controls[globalFormObject.control_index].label);
				$controlElement.find('a').attr('href', globalFormObject.obj.categories[_cat_index - 1002].sections[globalFormObject.sect_index - 1].controls[globalFormObject.control_index].url);
				$controlElement.find('a').attr('class', globalFormObject.obj.categories[_cat_index - 1002].sections[globalFormObject.sect_index - 1].controls[globalFormObject.control_index].class);
				_ctrl_index++;
				globalFormObject.control_index++;				
			}

		} else {

				if($controlElement.children().hasClass("group1")) {

					$controlElement[0].id = "CTRL-DIV-"+(_ctrl_index);
					model[$controlElement[0].id] = {id: $controlElement[0].id, pairs: [], required_field: false, name: $controlElement.find('select.group1').attr('name')};
					$controlElement.find("[type='radio']").attr("name", "row"+_ctrl_index.toString());

					var options = '';
					var parts = '';

					/* Assigning a unique name and id to comboboxes on drop */
						$controlElement.find("select.group1").attr("name", "submitted_name" + name_count++).attr("id", count++);
						$controlElement.find('.group1').children().each(function(i,o) {options += o.text + '\n'});
						$controlElement.find('.group2:hidden').children().each(function(i,o) {parts += o.text + '\n'});
						
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
					model[$controlElement[0].id] = {type: "ctrl-ron", required_field: false, name: $controlElement.attr('name')};

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
	    top: 50
	  }
	});


});

