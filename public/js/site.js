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

	/**0
	* Drop handler that will be initially attached to our main drop field
	**/

	function initialDropHandler(e, ui) {
	/**
	* create a copy of the dropped category div and set appropriate values	
	**/
		var $category = ui.draggable.clone();
		$category.removeClass("catField draggableField ui-draggable ui-draggable-handle");
		$category.addClass("droppedCategory");
		$category[0].id = "CTRL-DIV-"+(_cat_index++);
		// attach our new element to where it was dropped

		var model = {};
		// console.log($category.prop('id'));
		

		$category.appendTo(this);
		// make the new category element droppable		
		makeDroppable($category, '.sectField', categoryDropHandler);


		$(document).on('click', '.droppedCategory', function(e) {
		    e.stopImmediatePropagation(); e.preventDefault(); 
            var me = $(this)
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
		$section.removeClass("draggableField ui-draggable ui-draggable-handle elemField");
		$section.addClass("droppedSect");
		$section[0].id = "CTRL-DIV-"+(_sect_index++);
		$section.appendTo(this);

		var model = {};

		
		makeDroppable($section, '.elemField', sectionDropHandler);

		$(document).on('click', '.droppedSect', function(e) {
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
		$controlElement.removeClass("draggableField ui-draggable ui-draggable-handle elemField");
		$controlElement.addClass("droppedElem");
		$controlElement[0].id = "CTRL-DIV-"+(_ctrl_index++);
		$controlElement.find("[type='radio']").attr("name", "row"+_ctrl_index.toString());

		/* Assigning a unique name and id to comboboxes on drop */
		if($controlElement.children().hasClass("group1")) {
			$controlElement.find("select.group1").attr("name", "select-one" + name_count++).attr("id", count++);
		/* Assigning a unique name and id to select multiples on drop */	
		} else if ($controlElement.children().children().hasClass("group3")) {
			$controlElement.find("select.group3").attr("name", "select-multiple" + name_count_mult++).attr("id", "select" + count2++);
		/* Assigning a unique name and id to number types on drop */
		} else if ($controlElement.children().hasClass("number_group")) {
			$controlElement.find('.ctrl-number').attr("name", "num" + number_name_count++).attr("id", "number_id_" + number_count++);
		}

		var $radiosInSection = $controlElement.find("[type='radio']");
		var item = $(this).find('.ctrl-section');		
		
		$radiosInSection.each(function() {
			var $radio = $(this);
			$radio.attr("name", ($(item).text().replace(/\s/g,'')) + "__"  + (_ctrl_index.toString() - 3002));
		});

		$controlElement.parent().find('.required_radio').on("click", function() {
			var radioBtn = $controlElement.parent().find('.required_radio');
			var checkedCount = 0;
			radioBtn.each(function() {
				if($(this).is(":checked"))
					checkedCount++;
			});
			if(checkedCount > 1) {
				alert("Only one can be required");
				return false;
			}
		});
		
		$controlElement.appendTo(this);
		/* After dropping the control, attach the customization tool */
        
        $(document).on('click', '.droppedElem', function(e) {
        	e.stopImmediatePropagation(); e.preventDefault();
            var me = $(this)
            var ctrl = me.find("[class*=ctrl]")[0];
            var ctrl_type = $.trim(ctrl.className.match("ctrl-.*")[0].split(" ")[0].split("-")[1]);
            customize_ctrl(ctrl_type, this.id);
            console.log(this.id);
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
	    });



	/* JS FOR SIDEBAR FIXED POSITION SCROLLING */
	$('#sidebar').affix({
	  offset: {
	    top: 30
	  }
	});


});

