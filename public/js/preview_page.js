$('.group1').prepend('<option value="">Please make a selection</option>').val('');
$('.group3').prepend('<option value="">Please make a selection</option>').val('');


$('select').each(function(index, value) {
	if($(this).hasClass('required')) {
		console.log($(this).prop('class'));
		$(this).find('option:first').remove();
	}
	
});

    function output(inp) {
	    document.body.appendChild(document.createElement("pre")).innerHTML = inp;
	    $("html, body").animate({
	      scrollTop: $("pre").offset().top
	    }, 500);
  	};

   $('input[type="radio"]').click(function(e){
     var me = $(this);
     var name = me.prop('name');
       var value = me.val();
       if(value.substr(0,1) == 'r'){
         var pos = name.indexOf('__');
         var pre = name.substr(0,pos)+'__';
         $('input[type="radio"][name^="'+pre+'"][value^="r"]').each(function(index){
           if(this.checked){
             if(!(me.is(this))){
               alert("Only 1 can be Required.  Changing to N/A...");
               $('input[type="radio"][name="'+name+'"][value^="n"]').prop('checked', true);
             }
           }
         });
      }
     });

	var rules_array = [];
	loadRules();

	function loadRules() {
		$.ajax({
			type: 'get',
			url: '/getRulesData',
			data: {},
			success:function(data) {
				console.log(data);
				$.each(data, function(index, rule) {
					rules_array.push(rule);
				});
			}
		});			
	}
    
    $("#test-submit").on("click", function(event) {

// -------------- LOGIC THAT AUTOMATICALLY CHECKS A REQUIRED BUTTON IF CONFIG SAYS TO DO SO -------------- //
    	$('.droppedSect').each(function(i,o) {
    		var boolean_array = [];
    		var numOfTrue = 0;
    		$section_parent = $(this);
    		if($section_parent.hasClass('require_one')) {
    			var $required_buttons = $section_parent.find('.section-body').children().find('.required_radio');
    			$.each($required_buttons, function(i, option) {
    				boolean_array.push($(this).prop('checked'));
    			});	
    			for(var i=0; i<boolean_array.length; i++) {
    				if(boolean_array[i] == true)
    					numOfTrue++;
    			}
    			if(numOfTrue <= 0) {
    				$section_parent.find('.section-body').find('.required_radio:first').prop('checked', true);
    			}
    		}
    	});

// ------------- GETS ALL RULES FROM DATABASE AND DETERMINES WHICH APPLY TO THE GIVEN CONFIGURATION --------------- // 
        var config_title = $("#form_header").text();
	     	$("#work-area").find("input[type='radio']").each(function(i,o){
	           var btn = $(this);
	           var btn_name = $(this).attr("name");
	           	$.each(rules_array, function(index, rule) {
	           		var prefix = rule.input_1.substr(0, 1);
	                if(config_title == rule.directory_label && btn_name == rule.submitted_output
	                	&& rule.input_2 == $('[name="'+rule.submitted_name_2 + '"]').val()) {
						var prefix_name = $('[name="'+rule.submitted_name_1 +'"]:checked').val();
						if(prefix_name != undefined && prefix == prefix_name.substr(0,1)) {
							console.log(prefix_name.substr(0,1), btn_name);
		                     if(btn.hasClass("required_radio")) {
		                       btn.val("r(" + rule.output + ")");
		                     } else if (btn.hasClass("optional_radio")){ 
		                       btn.val("o(" + rule.output + ")");
		                     } else if (btn.hasClass("na_radio")) {
		                       btn.val("n(" + rule.output + ")");
		                     } else {
		                       btn.val(rule.output);
		                       // console.log("OUTPUT:", rule.output);
		                     }
						// } else if(prefix_name == "" || undefined) {
		    //                  if(btn.hasClass("required_radio")) {
		    //                    btn.val("r");
		    //                  } else if (btn.hasClass("optional_radio")){ 
		    //                    btn.val("o");
		    //                  } else {
		    //                    btn.val("n");
		    //                  }
						}

		                if(rule.input_1 == $('[name="'+rule.submitted_name_1 + '"]').val()
		                && rule.input_2 == $('[name="'+rule.submitted_name_2 + '"]').val()
		                && rule.input_3 == $('[name="'+rule.submitted_name_3 + '"]').val()) {
		                    if(btn.hasClass("required_radio")) {
		                       btn.val("r(" + rule.output + ")");
		                    } else if (btn.hasClass("optional_radio")){ 
		                       btn.val("o(" + rule.output + ")");
		                    } else if (btn.hasClass("na_radio")) {
		                       btn.val("n(" + rule.output + ")");
		                    } else {
		                       btn.val(rule.output);
		                       // console.log("OUTPUT:", rule.output);
		                    }
		                } else if($('[name="'+rule.submitted_name_1 + '"]').val() == ""
		                  && $('[name="'+rule.submitted_name_2 + '"]').val() == ""
		                  && $('[name="'+rule.submitted_name_3 + '"]').val() == "") {
		                     if(btn.hasClass("required_radio")) {
		                       btn.val("r");
		                     } else if (btn.hasClass("optional_radio")){ 
		                       btn.val("o");
		                     } else {
		                       btn.val("n");
		                     }
		                }
	               	}
	           	});
	        }); 

	// ------------- DISPLAYS THE NAME/VALUE PAIRS FROM THE FORM ON CLICK OF "TEST SUBMIT" --------------- //
	         var new_obj = {};
	         $.each($('form').serializeArray(), function(i,obj) {
	           new_obj[obj.name] = obj.value
	         });
	         var str = (JSON.stringify(new_obj, undefined, 3));
	         if ($("pre").length > 0) {
	           $("pre").remove();
	           output(str);
	         } else {
	           output(str);
	         }
	     
    });

	$('#close_window').click(function(){ window.close(); });   