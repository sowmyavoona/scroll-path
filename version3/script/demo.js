$(document).ready(init);

function init() {

	/* ========== DRAWING THE PATH AND INITIATING THE PLUGIN ============= */

	$.fn.scrollPath("getPath")

		.moveTo(400, 50, {name: "question-1"})
		.lineTo(400, 800, {name: "question-2"})
		.arc(200, 1200, 400, -Math.PI/2, Math.PI/2, true)
		.lineTo(600, 1600, {
			callback: function() {
				highlight($(".settings"));
			},
			name: "question-3"
		})
		.lineTo(1750, 1600, {
			callback: function() {
				highlight($(".sp-scroll-handle"));
			},
			name: "question-4"
		})
		.arc(1800, 1000, 600, Math.PI/2, 0, true, {rotate: Math.PI/2 })
		.lineTo(2400, 750, {
			name: "question-5"
		})
		.rotate(3*Math.PI/2, {
			name: "question-5-rotated"
		})
		.lineTo(2400, -700, {
			name: "question-6"
		})
		.arc(2250, -700, 150, 0, -Math.PI/2, true)
		.lineTo(1350, -850, {
			name: "question-7"
		})
		.lineTo( 720, -639, {
			name: "next-round"
		})
		.arc(1300, 50, 900, -(13/9)*Math.PI/2, -Math.PI, true, {rotate: Math.PI*2, name: "end"});
		
		/*
		// Move to 'question-1' element
		.moveTo(400, 50, {name: "question-1"})
		// Line to 'question-2' element
		.lineTo(400, 800, {name: "question-2"})
		// Arc down and line to 'question-3'
		.arc(200, 1200, 400, -Math.PI/2, Math.PI/2, true)
		.lineTo(600, 1600, {
			callback: function() {
				highlight($(".settings"));
			},
			name: "question-3"
		})
		// Continue line to 'question-4'
		.lineTo(1750, 1600, {
			callback: function() {
				highlight($(".sp-scroll-handle"));
			},
			name: "question-4"
		})
		// Arc up while rotating
		.arc(1800, 1000, 600, Math.PI/2, 0, true, {rotate: Math.PI/2 })
		// Line to 'question-5'
		.lineTo(2400, 750, {
			name: "question-5"
		})
		// Rotate in place
		.rotate(3*Math.PI/2, {
			name: "question-5-rotated"
		})
		// Continue upwards to 'source'
		.lineTo(2400, -700, {
			name: "source"
		})
		// Small arc downwards
		.arc(2250, -700, 150, 0, -Math.PI/2, true)

		//Line to 'follow'
		.lineTo(1350, -850, {
			name: "follow"
		})
		// Arc and rotate back to the beginning.
		.arc(1300, 50, 900, -Math.PI/2, -Math.PI, true, {rotate: Math.PI*2, name: "end"});
*/
	// We're dquestion-1 with the path, let's initate the plugin on our wrapper element
	$(".wrapper").scrollPath({drawPath: true, wrapAround: true});

	// Add scrollTo on click on the navigation anchors
	$("nav").find("a").each(function() {
		var target = $(this).attr("href").replace("#", "");
		$(this).click(function(e) {
			e.preventDefault();
			
			// Include the jQuery easing plugin (http://gsgd.co.uk/sandbox/jquery/easing/)
			// for extra easing functions like the question-1 below
			$.fn.scrollPath("scrollTo", target, 1000, "easeInOutSine");
		});
	});
	/* sowmya wrote this one */
		var elem = window.location.hash.substr(1);
			if(elem){
				var x =$('#'+elem);
				var target = x.attr("href").replace("#", "");
				$.fn.scrollPath("scrollTo",target, 1000, "easeInOutSine");
			}
	
	
	/* ===================================================================== */

	/*$(".settings .show-path").click(function(e) {
		e.preventDefault();
		$(".sp-canvas").toggle();
	}).toggle(function() {
		$(this).text("Hide Path");
	}, function() {
		$(this).text("Show Path");
	});

	$(".tweet").click(function(e) {
		open(this.href, "", "width=550, height=450");
		e.preventDefault();
	}); 
*/
	$.getJSON("http://cdn.api.twitter.com/1/urls/count.json?callback=?&url=http%3A%2F%2Fjoelb.me%2Fscrollpath",
			function(data) {
				if(data && data.count !== undefined) {
					$(".follow .count").html("the " + ordinal(data.count + 1) + " kind person to");
				}
			});
	}


function highlight(element) {
	if(!element.hasClass("highlight")) {
		element.addClass("highlight");
		setTimeout(function() { element.removeClass("highlight"); }, 2000);
	}
}
function ordinal(num) {
	return num + (
		(num % 10 == 1 && num % 100 != 11) ? 'st' :
		(num % 10 == 2 && num % 100 != 12) ? 'nd' :
		(num % 10 == 3 && num % 100 != 13) ? 'rd' : 'th'
	);
}
