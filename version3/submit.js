	

function updateLevel(levelNo){
	if(levelNo <= 7) {
		$(".levelList ul").append("<li><a class=\"item-a\" href=\"#question-"+levelNo+"\">"+levelNo+"</a></li>");
	} else if (levelNo == 8) {
		if ($(".levelList").find('a.next-round-li').length == 0) {
			
			$(".levelList ul").append("<li><a class=\"item-a next-round-li\" href=\"#next-round\"> &rarr; </a></li>");

			$(".levelList").find("a").each(function() {
						var target = $(this).attr("href").replace("#", "");
						$(this).click(function(e) {
							e.preventDefault();
							
							// Include the jQuery easing plugin (http://gsgd.co.uk/sandbox/jquery/easing/)
							// for extra easing functions like the question-1 below
							$.fn.scrollPath("scrollTo", target, 1000, "easeInOutSine");
						});
					});
					/*------------to scroll to next level -----------------*/
					$(".levelList").find("a").eq(7).trigger('click');
		}
	}
}

function updateQuestion(qNo, question, currint, userext, start){
	if(qNo <= 7) {
		var stringQ = '<div class="question-'+qNo+'">';
				stringQ +=  '<span class="big questionNo">' +question+ '</span> <span class="normal-text"> question-'+ qNo+'</span>';
				stringQ +='<form  id ="myform'+qNo+'"method="post">';
					stringQ +='<input type="hidden" id="input_level'+qNo+'" name="level" value="'+qNo+'">';
					stringQ +='<input type="text" id="input_answer'+qNo+'" name="answer" placeholder="type your answer here">';
					stringQ +='<br><input type="button" id="submitFormData'+qNo+'" onclick="';
					stringQ += 'SubmitFormData('+qNo+', '+currint+', '+userext+', '+start+');';
					stringQ += '" value="Submit" />';
				stringQ +='</form>';
			stringQ +=	'<p id="results'+qNo+'" > </p>';
			stringQ +='</div>';
		$(".wrapper").append(''+stringQ);
	} else if (qNo == 8) {
		$(".next-round").show();

	}
}

function SubmitFormData(questionNo, currint, userext, start) {
    var answer = $("#input_answer"+questionNo).val();
    var level = $("#input_level"+questionNo).val();
    $.post("submit.php", { answer:answer, level: level, currint: currint, userext: userext, start: start},
    
    function(data) {
		var trimmed_data = $.trim(data);
		if(trimmed_data=="Good job"){
			$("#results"+questionNo).html(data);
			$(".levelList").find("a").eq(questionNo).trigger('click');
		}
		else if(trimmed_data=="Oops try again"){
			$("#results"+questionNo).html(data);
			$(".levelList").find("a").eq(questionNo-1).trigger('click');
		}

		else {
			if(questionNo==7){
				$("#results"+questionNo).html("You're done with this round");
			}

			updateLevel(questionNo+1);
			updateQuestion(questionNo+1,trimmed_data);
			//$(".levelList").find("a").eq(questionNo).html(questionNo+1);
			/*--------- adds scrollpath thing to new level ---------------*/
				$(".levelList").find("a").each(function() {
						var target = $(this).attr("href").replace("#", "");
						$(this).click(function(e) {
							e.preventDefault();
							
							// Include the jQuery easing plugin (http://gsgd.co.uk/sandbox/jquery/easing/)
							// for extra easing functions like the question-1 below
							$.fn.scrollPath("scrollTo", target, 1000, "easeInOutSine");
						});
					});
					/*------------to scroll to next level -----------------*/
					$(".levelList").find("a").eq(questionNo).trigger('click');
			
		}
		
	$('#myform'+questionNo)[0].reset();
		setTimeout(function(){ $("#results"+questionNo).empty("");},1000);
    });
}
